<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use App\Model\VendorUser\VendorUser;
use Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use File;
class LoginController extends Controller
{
	use AuthenticatesUsers;
	protected $redirectTo = '/user/profile';
    public function getLogin(){
    	if(request()->next){
    	 session()->flash('next',request()->next);            
    	}
    	return view('user.auth.login');
    }
    public function postLogin(Request $request){
		$validator=Validator::make($request->all(),[	        
	        'email' => 'required|email|max:255',
	        'password' => 'required',
	    ]);
	     if ($validator->passes()) {
	     	    	$email=$request->email;
	     	    	$password=$request->password;
	     	    	$rememberToken=$request->remember;
	     	    	// now we use the Auth to Authenticate the users Credentials
	     			// Attempt Login for members
	     			if (Auth::guard()->attempt(['email' => $email, 'password' => $password], $rememberToken)) {
	     				$user=Auth::user();
	     				$url=route('user.resend_verification') . '?email=' . $user->email;
	     				if(!$user->active){
	     					Auth::logout();
		     				$msg = array(
		     					'success'  => 0,
		     					'message' => 'Please activate your account. <a href="'.$url.'">Resend verification email?</a>'
		     				);	     					
	     				}else{
	     					$request->session()->regenerate();

	     					$this->clearLoginAttempts($request);

	     					$r_url=$request->session()->get('next');

	     					if($r_url){
	     						$msg = array(
			     					'success'  => 1,
			     					'message' => 'Sucessfully Loggedin',
			     					'role'=>$user->role->name,
			     					'redirect_url'=>$user->role->name=='user'?$r_url:url('/vendor/dashboard'),
		     				   );

	     					}else{

			     				$msg = array(
			     					'success'  => 1,
			     					'message' => 'Sucessfully Loggedin',
			     					'role'=>$user->role->name,
			     					'redirect_url'=>$user->role->name=='user'?url('/user/profile'):url('/vendor/dashboard'),
			     				);
		     				}		     					
	     				}
	     				return response()->json($msg);
	     			} else {
	     				$msg = array(
	     					'success'  => 0,
	     					'message' => 'Wrong Credentials!!!'
	     				);
	     				return response()->json($msg);
	     			}
	     }else{
	     	return response()->json(['errors' => $validator->errors()]);
	     }
  
    	
    }
    public function getLogout(){
    	Auth::logout();
    	return redirect('/');
    }
    public function signupActivate($confirmation_code){
    	if( ! $confirmation_code)
    	{
    	    throw new InvalidConfirmationCodeException;
    	}

    	$verifyUser = User::where('activation_token', $confirmation_code)->first();



    	if(isset($verifyUser) ){
    	    $user = $verifyUser->user;
    	    if(!$verifyUser->active) {
    	        $verifyUser->active = 1;
    	        $verifyUser->activation_token = '';
    	        $verifyUser->save();
    	        $status = "Your e-mail is verified. You can now login.";
    	    }else{
    	        $status = "Your e-mail is already verified. You can now login.";
    	    }    	    
    	}else{
    	    return redirect('/user/login')->with('message', "Sorry your email cannot be identified.");
    	}

    	Session::flash('message',$status);

    	return redirect('/user/login');
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
			dd($input);
            $authUser = $this->findOrCreate($input);
            Auth::loginUsingId($authUser->id);
            return redirect()->intended($this->redirectTo);
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

            return $user;
        }
    
}
