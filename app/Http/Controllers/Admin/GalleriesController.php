<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Vendor;
use File;
use Image;
use App\Model\Vendor\Gallery;
class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $vendor=Vendor::where('slug',$slug)->firstOrFail();
        $galleries=$vendor->galleries;
        return view('admin.vendors.galleries.gallery',compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $vendor=Vendor::where('slug',$slug)->firstOrFail();
        return view('admin.vendors.galleries.add',compact('vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$slug)
    {
        $i=0;
        foreach($request->file('photo') as $file){            
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/vendor/gallery/', $name);
            $thumbnailpath = public_path().'/uploads/vendor/gallery/'.$name;
            $thumbnailpath1 = public_path().'/uploads/vendor/gallery/800x800/'.$name;
            $thumbnailpath2 = public_path().'/uploads/vendor/gallery/1200x1200/'.$name;
            $thumbnailpath3 = public_path().'/uploads/vendor/gallery/200x200/'.$name;
            $img1 = Image::make($thumbnailpath)->resize(800, 800, function($constraint) {
                        $constraint->aspectRatio();
                    });
            $img1->save($thumbnailpath1);
            $img2 = Image::make($thumbnailpath)->resize(1200, 1200, function($constraint) {
                        $constraint->aspectRatio();
                    });
            $img2->save($thumbnailpath2);
            $img3 = Image::make($thumbnailpath)->resize(200, 200, function($constraint) {
                        $constraint->aspectRatio();
                    });
            $img3->save($thumbnailpath3);
            $status=$request->status[$i]; 
            $caption=$request->caption[$i];
            Gallery::create([
            'photo'=>$name,
            'caption'=>$caption,
            'status'=>$status,
            'vendor_id'=>$request->vendor_id,
           ]);
           $i++;
        }
        return response()->json(['msg'=>'New Photos has been added.']); 
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {

        $vendor=Vendor::where('slug',$slug)->firstOrFail();
        $gallery=Gallery::where('vendor_id',$vendor->id)->where('id',request()->id)->firstOrFail();
        return view('admin.vendors.galleries.edit',compact('vendor','gallery'));
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
        $vendor=Vendor::where('slug',$slug)->firstOrFail();
        $gallery=Gallery::where('vendor_id',$vendor->id)->where('id',request()->id)->firstOrFail();
        $gallery->caption=$request->caption;
        $gallery->status=$request->status;
        if($request->hasFile('photo')){
            if(File::exists('uploads/vendor/gallery/'.$gallery->photo)){
                unlink('uploads/vendor/gallery/'.$gallery->photo);
                unlink('uploads/vendor/gallery/200x200/'.$gallery->photo);
                unlink('uploads/vendor/gallery/800x800/'.$gallery->photo);
                unlink('uploads/vendor/gallery/1200x1200/'.$gallery->photo);
            }
            $file=$request->file('photo');
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/uploads/vendor/gallery/', $name);
            $thumbnailpath = public_path().'/uploads/vendor/gallery/'.$name;
            $thumbnailpath1 = public_path().'/uploads/vendor/gallery/800x800/'.$name;
            $thumbnailpath2 = public_path().'/uploads/vendor/gallery/1200x1200/'.$name;
            $thumbnailpath3 = public_path().'/uploads/vendor/gallery/200x200/'.$name;
            $img1 = Image::make($thumbnailpath)->resize(800, 800, function($constraint) {
                        $constraint->aspectRatio();
                    });
            $img1->save($thumbnailpath1);
            $img2 = Image::make($thumbnailpath)->resize(1200, 1200, function($constraint) {
                        $constraint->aspectRatio();
                    });
            $img2->save($thumbnailpath2);  
            $img3 = Image::make($thumbnailpath)->resize(200, 200, function($constraint) {
                        $constraint->aspectRatio();
                    });
            $img3->save($thumbnailpath3);  
            $gallery->photo=$name;          
        }
        $gallery->save();
        return redirect()->route('admin.vendor',['slug'=>$vendor->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $vendor=Vendor::where('slug',$slug)->firstOrFail();
        $gallery=Gallery::where('vendor_id',$vendor->id)->where('id',request()->id)->firstOrFail();
        if(File::exists('uploads/vendor/gallery/'.$gallery->photo)){
            unlink('uploads/vendor/gallery/'.$gallery->photo);
            unlink('uploads/vendor/gallery/200x200/'.$gallery->photo);
            unlink('uploads/vendor/gallery/800x800/'.$gallery->photo);
            unlink('uploads/vendor/gallery/1200x1200/'.$gallery->photo);
        }
        $gallery->delete();
        return response()->json(['msg'=>'Photos has been deleted.']); 
    }
}
