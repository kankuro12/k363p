<?php

namespace App\Http\Controllers\Need;

use App\Http\Controllers\Controller;
use App\Model\VendorUser\VendorUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use File;
use App\FileUpload;
class UserController extends Controller
{
    public function index(Request $request){
        if($request->getMethod()=="POST"){

        }else{

            $user=Auth::user()->vendoruser;
            return view('themes.needtech.user.index',compact('user'));
        }
    }

    public function changePic(Request $request){
        $validator=Validator::make($request->all(),[
            'file'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->passes()) {
            $user=Auth::user();
            $user=VendorUser::where('user_id',$user->id)->firstOrFail();
            if($request->hasFile('file')){
                if(File::exists('uploads/user/profile_img/'.$user->profile_img) && $user->profile_img!='profile.png'){
                unlink('uploads/user/profile_img/'.$user->profile_img);
                unlink('uploads/user/profile_img/200x200/'.$user->profile_img);
            }
                $user->profile_img=FileUpload::photo($request,'file','','uploads/user/profile_img',[[200,200]]);
            }
            $user->save();
            return response()->json([
                 'message' => 'Profile picture has been updated successfully!!!.','success' => '1','profile_img'=>$user->profile_img
            ], 200);
        }
    }

    public function logout(){
        Auth::logout();
    }

    public function updateProfile(Request $request){
        $validator=Validator::make($request->all(),[
            'fname'=>'required',
            'lname'=>'required',
            'mobile_number'=>'required',
            'address'=>'required',
            'city_id'=>'required'
           ],[
             'fname.required'=>'Enter First name',
             'lname.required'=>'Enter Last name',
             'mobile_number.required'=>'Enter Mobile number',
             'address.required'=>'Enter your address',
           ]);

          if ($validator->passes()) {
              $user=Auth::user();
              $vuser=VendorUser::where('user_id',$user->id)->firstOrFail();
              $vuser->fname=$request->fname;
              $vuser->lname=$request->lname;
              $vuser->mobile_number=$request->mobile_number;
              $vuser->location=$request->address;
              $vuser->city_id=$request->city_id;
              $user->save();
              $vuser->save();
              return redirect()->back()->with('$msg',"Profile Update Sucessfully");
          }
          return redirect()->back()->with('$msg',"Profile Update Sucessfully");
    }
}
