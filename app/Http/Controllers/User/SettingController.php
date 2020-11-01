<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;
use Auth;
use App\Model\VendorUser\VendorUser;
class SettingController extends Controller
{
    public function get_settings_change_email (){
    	$user=Auth::user();
    	$user=VendorUser::where('user_id',$user->id)->firstOrFail(); 
        return view('user.settings.getSettingsEmailChange',compact('user'));
    }
    
    public function post_settings_change_email(Request $request){
        if(strcmp($request->get('currentEmail'), Auth::user()->email) != 0){
            //Current email address and new email address are same
            return redirect()->back()->with("error","Your current email address does not matches with the email address you provided. Please try again.");
        }
        if(strcmp($request->get('currentEmail'), $request->get('newEmail')) == 0){
            //Current email address and new email address are same
            return redirect()->back()->with("error","New email address cannot be same as your current email address. Please choose a different email address.");
        }
        $user = Auth::user();
        $user->email =$request->get('newEmail');
        $user->save();        
        return redirect()->back()->with("info","Email address changed successfully !");        
    }
    public function get_settings_change_password(){
    	$user=Auth::user();
    	$user=VendorUser::where('user_id',$user->id)->firstOrFail(); 
        return view('user.settings.getSettingsPasswordChange',compact('user'));
    }
    public function post_settings_change_password(Request $request){
        if (!(Hash::check($request->get('currentPassword'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }         
        if(strcmp($request->get('currentPassword'), $request->get('password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        } 
        $validatedData = $request->validate([
            'currentPassword' => 'required',
            'newpassword' => 'required|string|min:8|confirmed',
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();
        return redirect()->back()->with("info","Password changed successfully !");        
    }    
}
