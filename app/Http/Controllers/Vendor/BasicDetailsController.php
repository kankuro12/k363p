<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Country;
use App\Model\Vendor\Vendor;
use Auth;
use Illuminate\Support\Facades\Validator;
use File;
use App\FileUpload;
use App\Model\Vendor\Policy;
use Image;
use App\Model\Vendor\Gallery;
use App\Model\Vendor\Amenity;
use App\Model\Vendor\City;
use App\Model\Vendor\Location;
class BasicDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user=Auth::user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $countries=Country::all();
        if(request()->ajax()){
           return view('vendor.basic_details.ajax.index',compact('countries','vendor'));
        }
        return view('vendor.basic_details.index',compact('countries','vendor'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $validator=Validator::make($request->all(),[
            'vname' => 'required|string',
            'email' => 'required|string|email',
            'category_id'=>'required',
            'phone_number'=>'required',

            'description'=>'required',
        ]);

        if ($validator->passes()) {
            $user=Auth::user();
            $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
            $vendor->name=$request->vname;
            $vendor->phone_number=$request->phone_number;
            $vendor->secondary_phone_number=$request->secondary_phone_number;
            $vendor->secondary_email=$request->secondary_email;
            $vendor->facebook_url=$request->facebook_url;
            $vendor->twitter_url=$request->twitter_url;
            $vendor->instagram_url=$request->instagram_url;
            $vendor->tripadvisor_url=$request->tripadvisor_url;
            $vendor->description=$request->description;
            $vendor->average_cost=$request->average_cost??0;
            $vendor->star=1;
            $vendor->website=$request->website;
            $vendor->featured_start_time=$request->featured_start_time;
            $vendor->featured_end_time=$request->featured_end_time;
            $vendor->featured=$request->featured;
            $vendor->save();

            $location_data=[
                'vendor_id'=>$vendor->id,
                'city_id'=>$request->city_id,
                'name'=>$request->location_name??'',
                'lat'=>$request->lat??0,
                'lng'=>$request->lng??0,

            ];



            Location::updateOrCreate(['vendor_id' =>$vendor->id],$location_data);

            return response()->json([
                 'message' => 'Basic Details has been updated successfully!!!.','success' => '1','data'=>$request->all()
            ], 200);

        }
        return response()->json(['errors' => $validator->errors()]);
    }
    function change_profile_pic(Request $request){
        $validator=Validator::make($request->all(),[
            'file'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        if ($validator->passes()) {
            $user=Auth::user();
            $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
            if($request->hasFile('file')){
                if(File::exists('uploads/vendor/logo/'.$vendor->logo)&& $vendor->logo!='logo.png'){
                unlink('uploads/vendor/logo/'.$vendor->logo);
                unlink('uploads/vendor/logo/263x160/'.$vendor->logo);
            }
                $vendor->logo=FileUpload::photo($request,'file','','uploads/vendor/logo',[[263,160]]);
            }
            $vendor->save();
            return response()->json([
                 'message' => 'Profile picture has been updated successfully!!!.','success' => '1','logo'=>$vendor->logo
            ], 200);

        }
        return response()->json(['errors' => $validator->errors()]);
    }
    function change_cover_pic(Request $request){
        $validator=Validator::make($request->all(),[
            'file'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=1050,min_height=600',
        ]);
        if ($validator->passes()) {
            $user=Auth::user();
            $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
            if($request->hasFile('file')){
                if(File::exists('uploads/vendor/cover_img/'.$vendor->cover_img) && $vendor->cover_img!='cover.png'){
                    unlink('uploads/vendor/cover_img/'.$vendor->cover_img);
                    unlink('uploads/vendor/cover_img/545x300/'.$vendor->cover_img);
                    // unlink('uploads/vendor/cover_img/800x800/'.$vendor->cover_img);
                    // unlink('uploads/vendor/cover_img/1200x1200/'.$vendor->cover_img);
                }
                $vendor->cover_img=FileUpload::photo($request,'file','','uploads/vendor/cover_img',[[545,300]]);
            }

            $vendor->save();
            return response()->json([
                 'message' => 'Cover Image has been updated successfully!!!.','success' => '1','cover_img'=>$vendor->cover_img
            ], 200);

        }
        return response()->json(['errors' => $validator->errors()]);
    }
    function privacy_policy(){
        $user=Auth::user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $policies=$vendor->policy;
        if(request()->ajax()){
           return view('vendor.privacy_policy.ajax.index',compact('policies'));
        }
        return view('vendor.privacy_policy.index',compact('policies'));
    }
    function privacy_policy_update(Request $request){
        $validator=Validator::make($request->all(),[
            'check_in_time'=>'required',
            'check_out_time'=>'required',
            'check_in_out_policy'=>'required',
            'cancelation_policy'=>'required',
            'extra_bed_policy'=>'required',
            'payment_mode'=>'required',
            'description'=>'string',
        ]);
        if ($validator->passes()) {
            $user=Auth::user();
            $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
            $input=$request->only('check_in_out_policy','cancelation_policy','extra_bed_policy','payment_mode','description','check_in_time','check_out_time');
            $input['vendor_id']=$vendor->id;
            $policy =Policy::updateOrCreate(['vendor_id' =>$vendor->id],$input);
            $policy->save();
            return response()->json([
                 'message' => 'Privacy Policy has been updated successfully!!!.','success' => '1'
            ]);

        }
        return response()->json(['errors' => $validator->errors()]);
    }
    function get_gallery(Request $request){
        $user=Auth::user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $galleries=$vendor->galleries;
        if($request->ajax()){
          return view('vendor.gallery.ajax.index',compact('galleries'));
        }
       return view('vendor.gallery.index');
    }
    function delete_gallery(Request $request){
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $gallery=$vendor->galleries()->where('id',$request->id)->firstOrFail();
        if(File::exists('uploads/vendor/gallery/'.$gallery->photo)){
            unlink('uploads/vendor/gallery/'.$gallery->photo);
            unlink('uploads/vendor/gallery/263x160/'.$gallery->photo);
        }
        $gallery->delete();
        return response()->json(['message'=>'Photo has been removed successfully.','success'=>1]);
    }
    function post_gallery(Request $request){
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $i=0;
        foreach($request->file('photo') as $file){
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/vendor/gallery/', $name);
            $thumbnailpath = public_path().'/uploads/vendor/gallery/'.$name;
            $thumbnailpath1 = public_path().'/uploads/vendor/gallery/263x160/'.$name;
            $img1 = Image::make($thumbnailpath)->resize(263, 160, function($constraint) {
                        $constraint->aspectRatio();
                    });
            $img1->save($thumbnailpath1);
            $status=$request->status[$i];
            $caption=$request->caption[$i];
            Gallery::create([
            'photo'=>$name,
            'caption'=>$caption,
            'status'=>$status,
            'vendor_id'=>$vendor->id,
           ]);
           $i++;
        }
        return response()->json(['message'=>'Photo has been updated successfully.','success'=>1]);
    }
    function get_edit_gallery(Request $request){
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $gallery=Gallery::where('vendor_id',$vendor->id)->where('id',request()->id)->firstOrFail();
        return view('vendor.gallery.edit',compact('vendor','gallery'));
    }
    function edit_post_gallery(Request $request){
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $gallery=Gallery::where('vendor_id',$vendor->id)->where('id',$request->id)->firstOrFail();
        $gallery->caption=$request->caption;
        $gallery->status=$request->status;
        if($request->hasFile('file')){
            if(File::exists('uploads/vendor/gallery/'.$gallery->photo)){
                unlink('uploads/vendor/gallery/'.$gallery->photo);
                unlink('uploads/vendor/gallery/263x160/'.$gallery->photo);
            }
        $gallery->photo=FileUpload::photo($request,'file','','uploads/vendor/gallery',[[263,160]]);

        }

        $gallery->save();
        return response()->json(['message'=>'Photo has been updated successfully.','success'=>1]);
    }
    function get_amenities(Request $request){
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $amenities=Amenity::where('status','active')->get();
        if(request()->ajax()){
           return view('vendor.amenities.ajax.index',compact('amenities','vendor'));
        }
        return view('vendor.amenities.index');
    }
    function change_amenity(Request $request){
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $a=$vendor->amenities()->where('amenity_id',$request->aid)->first();
        if($a){
             $vendor->amenities()->detach($request->aid);
        }else{
            $vendor->amenities()->attach($request->aid);
        }
        return response()->json($request->all());
    }


}
