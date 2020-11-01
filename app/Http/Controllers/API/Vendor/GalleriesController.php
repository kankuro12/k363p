<?php

namespace App\Http\Controllers\API\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Gallery;
use App\Model\Vendor\Vendor;
use File;
use App\FileUpload;
class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $galleries=$vendor->galleries;
        return response()->json($galleries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption'=>'string',
            'status'=>'required'
        ]);
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $gallery=new Gallery();
        $gallery->vendor_id=$vendor->id;
        $gallery->caption=$request->caption;
        $gallery->status=$request->status;
        if($request->hasFile('photo')){
            $gallery->photo=FileUpload::photo($request,'photo','','uploads/vendor/gallery',[[200,200],[800,800],[1200,1200]]);
        }
        $gallery->save();
        return response()->json($gallery);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $gallery=$vendor->galleries()->where('id',$id)->firstOrFail();
        return response()->json($gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'photo'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'caption'=>'string',
            'status'=>'required'
        ]);
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $gallery=$vendor->galleries()->where('id',$id)->firstOrFail();
        if($request->has('caption')){
            $gallery->caption=$request->caption;
        }
        if($request->hasFile('photo')){
            if(File::exists('uploads/vendor/gallery/'.$gallery->photo)){
                unlink('uploads/vendor/gallery/'.$gallery->photo);
                unlink('uploads/vendor/gallery/200x200/'.$gallery->photo);
                unlink('uploads/vendor/gallery/800x800/'.$gallery->photo);
                unlink('uploads/vendor/gallery/1200x1200/'.$gallery->photo);
            }
            $gallery->photo=FileUpload::photo($request,'photo','','uploads/vendor/gallery/',[[200,200],[800,800],[1200,1200]]);
        }
        $gallery->status=$request->status;
        $gallery->save();
        return response()->json($gallery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $gallery=$vendor->galleries()->where('id',$id)->firstOrFail();
        if(File::exists('uploads/vendor/gallery/'.$gallery->photo)){
            unlink('uploads/vendor/gallery/'.$gallery->photo);
            unlink('uploads/vendor/gallery/200x200/'.$gallery->photo);
            unlink('uploads/vendor/gallery/800x800/'.$gallery->photo);
            unlink('uploads/vendor/gallery/1200x1200/'.$gallery->photo);
        }
        $gallery->delete();
        return response()->json(['msg'=>'Gallery is successfully deleted.']);
    }
}
