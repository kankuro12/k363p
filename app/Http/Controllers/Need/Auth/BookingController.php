<?php

namespace App\Http\Controllers\Need\Auth;

use App\Http\Controllers\Controller;
use App\Model\VendorUser\VendorUser;
use App\Notifications\User\SignupActivate;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Http\Request;

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
            return view('themes.needtech.auth.login');
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
            return view('themes.needtech.auth.signup',compact('number'));
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
            return view('themes.needtech.auth.otp',compact('number'));
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
    }
}
