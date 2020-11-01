<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Amenity;
use File;
use Image;
use App\FileUpload;
class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Amenity::latest()->paginate(10);
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
            'name'=>'required|string',
            'icon'=>'image',
            'status'=>'required'
        ]);
        $amenity=new Amenity();
        $amenity->name=$request->name;
        $amenity->status=$request->status;
        if($request->hasFile('icon')){
            $amenity->icon=FileUpload::photo($request,'icon','','uploads/vendor/amenities/icons',[[200,200]]);
        }
        $amenity->save();
        return response()->json($amenity);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $amenity=Amenity::where('slug',$slug)->firstOrFail();
        return response()->json($amenity);

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
            'name'=>'required|string',
            'icon'=>'image',
            'status'=>'required'
        ]);
        $amenity=Amenity::where('slug',$slug)->firstOrFail();
        $amenity->name=$request->name;
        $amenity->status=$request->status;
        $amenity->slug=null;
        if($request->hasFile('icon')){
            if(File::exists('uploads/vendor/amenities/icons/'.$amenity->icon)){
                unlink('uploads/vendor/amenities/icons/'.$amenity->icon);
                unlink('uploads/vendor/amenities/icons/200x200/'.$amenity->icon);
            }
            $amenity->icon=FileUpload::photo($request,'icon','','uploads/vendor/amenities/icons',[[200,200]]);
        }
        $amenity->save();
        return response()->json($amenity);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $amenity=Amenity::where('slug',$slug)->firstOrFail();
        if(File::exists('uploads/vendor/amenities/icons/'.$amenity->icon)&& 'uploads/vendor/amenities/icons/'.$amenity->icon!='icon.png'){
            unlink('uploads/vendor/amenities/icons/'.$amenity->icon);
            unlink('uploads/vendor/amenities/icons/200x200/'.$amenity->icon);
        }
        $amenity->delete();
        return response()->json($amenity);
    }
}
