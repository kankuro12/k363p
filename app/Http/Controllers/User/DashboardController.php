<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Validator;
use File;
use App\FileUpload;
use App\Model\VendorUser\VendorUser;
use App\Model\Vendor\Country;
use App\Model\Vendor\State;
use App\Model\Vendor\City;
class DashboardController extends Controller
{
    public function index(){
    	$user=Auth::user()->vendoruser;
      $countries=Country::all();
      $states=State::all();
      $cities=City::all();
        if(request()->ajax()){
           return view('user.dashboard.ajax.index',compact('user','countries','states','cities'));           
        }
    	return view('user.dashboard.index',compact('user'));
    }
    public function change_profile_pic(Request $request){
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
        return response()->json(['errors' => $validator->errors()]);   
    }
    public function update_profile(Request $request){
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
               return response()->json([
                    'message' => 'Basic Details has been updated successfully!!!.','success' => '1',
               ], 200);

           }        
           return response()->json(['errors' => $validator->errors()]);          

    }
    public function get_notification($id){
        $data=Auth::guard()->user()->notifications()->where('id',$id)->firstOrFail();
        $data->markAsRead();
        $user=Auth::user();
        $user=VendorUser::where('user_id',$user->id)->firstOrFail(); 
        if($data->data['link']){
          return redirect()->to($data->data['link']);
        }
        return view('user.notification.notification',['data'=>$data]);
    }
    public function get_notifications(){
        $data=Auth::guard()->user()->notifications()->orderBy('created_at','desc')->get();
        $user=Auth::user();
        $user=VendorUser::where('user_id',$user->id)->firstOrFail(); 
        return view('user.notification.notifications',['data'=>$data,'user'=>$user]);
    }
}
