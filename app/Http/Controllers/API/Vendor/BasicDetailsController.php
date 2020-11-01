<?php

namespace App\Http\Controllers\API\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Vendor;
use File;
use Image;
use App\FileUpload;
class BasicDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=$request->user();
        $vendor=Vendor::with('user')->with('galleries')->where('user_id',$user->id)->firstOrFail();
        return response()->json($vendor);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id'=>'required',
            'phone_number'=>'required',
            'address'=>'required',
            'website'=>'url',
            'average_cost'=>'required',
            'logo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_img'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'secondary_email'=>'email',
            'facebook_url'=>'url',
            'twitter_url'=>'url',
            'instagram_url'=>'url',
            'description'=>'string',
        ]);

        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        if($request->hasFile('logo')){
            if(File::exists('uploads/vendor/logo'.$vendor->logo)&& 'uploads/vendor/logo'.$vendor->logo!='logo.png'){
                unlink('uploads/vendor/cover_img'.'uploads/vendor/logo'.$vendor->logo);
                unlink('uploads/vendor/cover_img'.'uploads/vendor/logo/200x200/'.$vendor->logo);
            }
            $vendor->logo=FileUpload::photo($request,'logo','','uploads/vendor/logo',[[200,200]]);
        }
        if($request->hasFile('cover_img')){
            if(File::exists('uploads/vendor/cover_img'.$vendor->cover_img)&& 'uploads/vendor/cover_img'.$vendor->cover_img!='cover.png'){
                unlink('uploads/vendor/cover_img'.$vendor->cover_img);
                unlink('uploads/vendor/cover_img/200x200/'.$vendor->cover_img);
                unlink('uploads/vendor/cover_img/800x800/'.$vendor->cover_img);
                unlink('uploads/vendor/cover_img/1200x1200/'.$vendor->cover_img);
            }
            $vendor->cover_img=FileUpload::photo($request,'cover_img','','uploads/vendor/cover_img',[[200,200],[800,800],[1200,1200]]);
        }
        $vendor->name=$request->name;
        $vendor->address=$request->address;
        $vendor->average_cost=$request->average_cost;
        $vendor->secondary_email=$request->secondary_email;
        $vendor->facebook_url=$request->facebook_url;
        $vendor->twitter_url=$request->twitter_url;
        $vendor->instagram_url=$request->instagram_url;
        $vendor->description=$request->description;
        $vendor->slug=null;
        $vendor->save();
        return response()->json($vendor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
