<?php

namespace App\Http\Controllers\Need\Auth;

use App\Http\Controllers\Controller;
use App\Model\VendorUser\VendorUser;
use App\Notifications\User\SignupActivate;
use Illuminate\Support\Facades\Auth;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use File;
class BookingController extends Controller
{
    public function login(Request $request){
        if($request->getMethod()=="POST"){
            $phone=$request->phone;
            $vu=VendorUser::where('mobile_number',$phone)->first();
            if($vu==null){
                return redirect()->back()->withInput()->withErrors(['No Account Exist with Phone No '.$phone.'. <a href="'.route('n.user.signup').'?number='.$phone.'">Create New Account</a>' ]);
            }else{
                $user=$vu->user;
                $user->activation_token=mt_rand(100000,999999);
                $user->save();
                $user->notify(new SignupActivate());
                session(['number'=>$request->phone]);
                return redirect()->route('n.user.otp');
            }
        }else{
            return view('themes.needtech.Auth.login');
        }
    }

    public function signup(Request $request){
        if($request->getMethod()=="POST"){
            $user=new User();
            if($request->email==null){
                $user->email=$request->phone."@abtest.com";
            }else{
                $user->email=$request->email;
            }
            $user->password=bcrypt('Password');
            $user->role_id=1;
            $user->activation_token=mt_rand(100000,999999);
            $user->save();

            $data=new VendorUser();
            $data->user_id=$user->id;
            $data->fname=$request->fname;
            $data->lname=$request->lname;
            $data->mobile_number=$request->phone;
            $data->save();
            $user->notify(new SignupActivate());
            session(['number'=>$request->phone]);
            return redirect()->route('n.user.otp');
        }else{
            $number="";
            if($request->filled('number')){
                $number=$request->number;
            }
            return view('themes.needtech.Auth.signup',compact('number'));
        }
    }

    public function otp(Request $request){
        if($request->getMethod()=="POST"){
            $data=VendorUser::where('mobile_number',$request->number)->first();
            if($data!=null){
                $user=$data->user;
                if($user->activation_token==$request->otp){
                    $request->session()->forget('number');
                    Auth::login($user,true);
                    if(session('redirect')==null){
                        return redirect()->route('user.profile');
                    }else{
                        return redirect(session('redirect'));
                    }
                }else{
                    return redirect()->back()->withInput()->withErrors(['Wrong OTP']);
                }
            }
        }else{
            $number=session('number');
            if($number==null){
                return redirect()->route('n.user.login');
            }
            return view('themes.needtech.Auth.otp',compact('number'));
        }
    }

    public function resendotp(Request $request){
        $data=VendorUser::where('mobile_number',$request->number)->first();
        if($data!=null){
            $user=$data->user;
            $user->activation_token=mt_rand(100000,999999);
            $user->save();
            $user->notify(new SignupActivate());
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route("n.user.login");
    }

    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider){
        try {
            $user = Socialite::driver($provider)->stateless()->user();

            $fname=explode(" ", $user->getName());
            $input['fname'] = $fname[0];
            $input['lname'] = $fname[1];
            $input['email'] = $user->getEmail();
            $input['provider'] = $provider;
            $input['provider_id'] = $user->getId();
			$input['ppic']=$user->getAvatar();
            $authUser = $this->findOrCreate($input);
            Auth::loginUsingId($authUser->id,true);
            if(session('redirect')==null){
                return redirect()->route('user.profile');
            }else{
                return redirect(session('redirect'));
            }
        }catch (Exception $e) {

            return redirect('user/auth/'.$provider);

        }
    }
    public function findOrCreate($input){
            $checkIfExist=User::where('provider',$input['provider'])
	                           ->where('provider_id',$input['provider_id'])
	                           ->orWhere('email',$input['email'])
	                           ->first();

            if($checkIfExist){
                return $checkIfExist;
            }
            $uinput['role_id']=1;
            $uinput['email']=$input['email'];
            $uinput['verified']=1;
            $uinput['active']=1;
            $uinput['provider']=$input['provider'];
            $uinput['provider_id']=$input['provider_id'];

            $user=User::create($uinput);

            if($input['ppic']){
                $fileContents = file_get_contents($input['ppic']);
                $name=$user->id.time().".jpg";
                File::put(public_path() . '/uploads/user/profile_img/' .$name, $fileContents);
                File::put(public_path() . '/uploads/user/profile_img/200x200/' .$name, $fileContents);
            }


            $vuser = VendorUser::create([
                'user_id' => $user->id,
                'fname'=>$input['fname'],
                'lname'=>$input['lname'],
                'profile_img'=>$name,
            ]);
			// dd($input,$vuser);

            return $user;
        }
}
