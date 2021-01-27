<?php

namespace App\Http\Controllers\Need;

use App\Http\Controllers\Controller;
use App\Model\VendorUser\VendorUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use File;
use App\FileUpload;
use App\Model\Vendor\Booking;

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

    // XXX bookings

    public function SingleBooking($code){
        // dd($code);
        $booking=Booking::where('booking_id',$code)->first();
        $user=Auth::user()->vendoruser;

        return view('themes.needtech.user.booking.single',compact('user','booking','code'));
    }
    public function booking(){
        // dd($code);
        $user=Auth::user()->vendoruser;
        $bookings=Booking::where('user_id',$user->id)->get();
        return view('themes.needtech.user.booking.index',compact('user','bookings'));
    }

    // XXX Notifications
    public function notification($id){
        $data=Auth::guard()->user()->notifications()->where('id',$id)->firstOrFail();
        $data->markAsRead();
        $user=Auth::user();
        $user=VendorUser::where('user_id',$user->id)->firstOrFail();
        if($data->data['link']){
          return redirect()->to($data->data['link']);
        }
        return view('themes.needtech.user.notification.single',['data'=>$data]);
    }
    public function notifications(){
        $data=Auth::guard()->user()->notifications()->orderBy('created_at','desc')->get();
        $user=Auth::user();
        $user=VendorUser::where('user_id',$user->id)->firstOrFail();
        return view('themes.needtech.user.notification.index',['notifications'=>$data,'user'=>$user]);
    }

    public function reviews(Request $request){
        if($request->getMethod()=="POST"){
            $user=Auth::user();
            $user=VendorUser::where('user_id',$user->id)->firstOrFail();

            $user->reviews()->create([
                'review_title'=>$request->review_title??'',
                'review_description'=>$request->review_description,
                'clean'=>$clean=$request->clean??0,
                'food'=>$food=$request->food??0,
                'comfort'=>$comfort=$request->comfort??0,
                'facility'=>$facility=$request->facility??0,
                'sbehaviour'=>$sbehaviour=$request->staff_behaviour??0,
                'vendor_id'=>$request->vendor_id,
                'booking_id'=>$request->booking_id,
                'avg_rating'=>$request->rating,
            ]);
            return redirect()->back();
        }else{
            $user=Auth::user();
            $reviews=$user->vendoruser->reviews;
            $to_reviewed=$user->vendoruser->bookings()->where('bookings.booking_status','completed')->whereDoesntHave('review')->get();
            return view('themes.needtech.user.reviews.index',compact('user','reviews','to_reviewed'));
        }
    }
}
