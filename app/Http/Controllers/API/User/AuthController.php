<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Auth;
use App\User;
use App\Model\VendorUser\VendorUser;
use App\Notifications\User\APISignupActivate;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'mobile_number' => 'unique:vendor_users|required|size:10|regex:/^[0-9]+$/i',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            //'g-recaptcha-response' => 'required|recaptcha'
        ],[
            'fname.required' => 'Firstname is mandatoy',
            'lname.required'  => 'Lastname is mandatory',
            'mobile_number.required'  => 'Mobile Number is mandatory',
            'mobile_number.size'  => 'Mobile Number must be 10 digit',
            'mobile_number.unique'  => 'Mobile Number number already exist',
            'mobile_number.regex'   => 'Invalid Mobile Number',
            'email.required'  => 'Email is mandatory',
            'email.unique'  => 'Email already exist',
            'email.regwx' => 'Invalid email',
            'gender.required'   => 'Please select gender',
            'password.required'  => 'Password is mandatory',
        ]);
        $input = $request->all();

        if ($validator->passes()) {

            $user = new User([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id'=>1,
                'activation_token' => mt_rand(100000, 999999),
            ]);
            $user->save();
            $vendor=VendorUser::create([
	            'fname'=>$request->fname,
                'lname'=>$request->lname,
	            'mobile_number'=>$request->mobile_number,	            
	            'user_id'=>$user->id,
            ]);
            $user->notify(new APISignupActivate($user));

            return response()->json([
                 'message' => 'Please verify your email','success' => '1'
            ], 201);
        }
        return response()->json(['errors' => $validator->errors()],500);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'type'=>$user->role_id,
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }
    public function logout(){

    }
    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }
}
