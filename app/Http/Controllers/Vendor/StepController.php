<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use App\FileUpload;
use App\Model\Vendor\Vendor;
use File;
class StepController extends Controller
{
    //
    public function step1(Request $request){
        if($request->getMethod()=="POST"){
            $validator=Validator::make($request->all(),[
                'code' => 'required|string',
            ]);
            
        if ($validator->passes()) {
            $verifyUser = User::where('activation_token', $request->code)->first();
            $verifyUser->active = 1;
            $verifyUser->activation_token = '';
            $verifyUser->save();
            $vendor=$verifyUser->vendor;
            $vendor->step=1;
            $vendor->save();
            return response()->json([
                'message' => 'Account Verified Sucessfully','success' => '1'
           ], 200);
        }
        return response()->json(['errors' => $validator->errors()]);
        }else{
           return view("vendor.step.step1") ;
        }
    }

    public function step2(Request $request){
    

        if($request->getMethod()=="POST"){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=1050,min_height=600',
            ]);
            $user=Auth::user();
            $vendor=Vendor::where('user_id',$user->id)->firstOrFail(); 
            if($request->hasFile('image')){
                if(File::exists('uploads/vendor/cover_img/'.$vendor->cover_img) && $vendor->cover_img!='cover.png'){
                    unlink('uploads/vendor/cover_img/'.$vendor->cover_img);
                    unlink('uploads/vendor/cover_img/545x300/'.$vendor->cover_img);
                    // unlink('uploads/vendor/cover_img/800x800/'.$vendor->cover_img);
                    // unlink('uploads/vendor/cover_img/1200x1200/'.$vendor->cover_img);
                }
                $vendor->cover_img=FileUpload::photo($request,'image','','uploads/vendor/cover_img',[[545,300]]);
            }           
            $vendor->step=2;
            $vendor->save(); 
            
            return redirect()->route('vendor.step3');
        
        }else{
           return view("vendor.step.step2") ;
        }
    }

    public function step3(Request $request){
    

        if($request->getMethod()=="POST"){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
            ]);
           
            $user=Auth::user();
            $vendor=Vendor::where('user_id',$user->id)->firstOrFail(); 
            if($request->hasFile('image')){
                if(File::exists('uploads/vendor/logo/'.$vendor->logo)&& $vendor->logo!='logo.png'){
                unlink('uploads/vendor/logo/'.$vendor->logo);
                unlink('uploads/vendor/logo/263x160/'.$vendor->logo);
            }
                $vendor->logo=FileUpload::photo($request,'image','','uploads/vendor/logo',[[263,160]]);
            }  
            $vendor->step=3;
            $vendor->save(); 
            
            return redirect()->route('vendor.dashboard');
        
        }else{
           return view("vendor.step.step3") ;
        }
    }
}
