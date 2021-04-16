<?php

namespace App\Http\Controllers\API\User;

use App\FileUpload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Auth;
use App\User;
use App\Model\VendorUser\VendorUser;
use App\Notifications\User\APISignupActivate;
use App\Notifications\User\SignupActivate;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $phone = $request->phone;
        $vu = VendorUser::where('mobile_number', $phone)->first();
        if ($vu == null) {
            return response()->json(['status' => false, 'message' => "No Account Exist with Phone No " . $phone]);
        } else {
            $user = $vu->user;
            $user->activation_token = mt_rand(100000, 999999);
            $user->save();
            $user->notify(new SignupActivate());
            session(['number' => $request->phone]);
            return response()->json(['status' => true]);
        }
    }

    public function signup(Request $request)
    {
        $phone = $request->phone;
        $vu = VendorUser::where('mobile_number', $phone)->first();
        if ($vu != null) {
            return response()->json(['status' => false, 'message' => "Account already Exist with Phone No " . $phone]);
        }

        $user = new User();
        if ($request->email == null || $request->email == "") {
            $user->email = $request->phone . "@abtest.com";
        } else {
            $user->email = $request->email;
            if (User::where('email', $request->email)->count() > 0) {
                return response()->json(['status' => false, 'message' => "Account already Exist with email " . $request->email]);
            }
        }
        $user->password = bcrypt('xyzerpnepal');
        $user->role_id = 1;
        $user->activation_token = mt_rand(100000, 999999);
        $user->save();

        $data = new VendorUser();
        $data->user_id = $user->id;
        $data->fname = $request->fname;
        $data->lname = $request->lname;
        $data->mobile_number = $request->phone;
        $data->save();
        $user->notify(new SignupActivate());
        return response()->json(['status' => true, 'message' => "Account Created Sucessfully"]);
    }

    public function otp(Request $request)
    {

        $data = VendorUser::where('mobile_number', $request->number)->first();
        if ($data == null) {
            return response()->json(['status' => false, 'message' => "No Account Exist with Phone No " . $request->number]);
        } else {
            $user = $data->user;
            if ($user->activation_token == $request->otp) {
                $user->activation_token = "";
                $user->save();
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                if ($request->remember_me)
                    $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();
                return response()->json([
                    'status' => true,
                    'user' => $user,
                    'acc' => $data,
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'type' => $user->role_id,
                    'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
                ]);
            } else {
                return response()->json(['status' => true, 'message' => 'wrong otp']);
            }
        }
    }

    public function resendotp(Request $request)
    {
        $data = VendorUser::where('mobile_number', $request->number)->first();
        if ($data == null) {
            return response()->json(['status' => false, 'message' => "No Account Exist with Phone No " . $request->number]);
        } else {
            $user = $data->user;
            $user->activation_token = mt_rand(100000, 999999);
            $user->save();
            $user->notify(new SignupActivate());
            return response()->json(['status' => true]);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $vuser = VendorUser::where('user_id', $user->id)->firstOrFail();
        $vuser->fname = $request->fname;
        $vuser->lname = $request->lname;
        // $vuser->mobile_number = $request->mobile_number;
        $vuser->location = $request->address;
        $vuser->city_id = $request->city_id;
        $user->save();
        $vuser->save();
        return response()->json(['status'=>true,'message'=>"Profile Updated Sucessfully"]);
    }

    public function changePic(Request $request){
        
        if($request->hasFile('file')){
                $user=Auth::user();
                $user=VendorUser::where('user_id',$user->id)->firstOrFail();
                if(File::exists('uploads/user/profile_img/'.$user->profile_img) && $user->profile_img!='profile.png'){
                    unlink('uploads/user/profile_img/'.$user->profile_img);
                    unlink('uploads/user/profile_img/200x200/'.$user->profile_img);
                }
                $user->profile_img=FileUpload::photo($request,'file','','uploads/user/profile_img',[[200,200]]);
                $user->save();
                return response()->json([
                     'message' => 'Profile picture has been updated successfully!!!.',
                     'success' => true,
                     'profile_img'=>$user->profile_img
                ], 200);
        }else{
            return response()->json(['status'=>false,'message'=>"Image  Not Uploaded"]);
        }
        
    }

    public function getOTP(Request $request){
        $data = VendorUser::where('mobile_number', $request->phone)->first();
        if ($data != null) {
            $user = $data->user;
            $user->activation_token = mt_rand(100000, 999999);
            $user->save();

        } else {

            $user = new User();
            if ($request->email == null) {
                $user->email = $request->phone . "@abtest.com";
            } else {
                $user->email = $request->email;
            }
            $user->password = bcrypt('Password');
            $user->role_id = 1;
            $user->activation_token = mt_rand(100000, 999999);
            $user->save();

            $data = new VendorUser();
            $data->user_id = $user->id;
            $data->fname = $request->fname;
            $data->lname = $request->lname;
            $data->mobile_number = $request->phone;
            $data->save();
        }
        $user->notify(new SignupActivate());
        return response()->json(['status' => true]);
    }
}
