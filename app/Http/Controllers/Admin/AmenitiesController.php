<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Amenity;
use File;
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
        $amenities=Amenity::latest()->get();
        return view('admin.amenities.index',compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.amenities.create');
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
        session()->flash('msg','New Service has beed successfully added.');
        return redirect()->route('admin.amenities');
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
        $amenity=Amenity::where('slug',$slug)->firstOrFail();
        return view('admin.amenities.edit',compact('amenity'));
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
        session()->flash('msg','Service has beed successfully updated.');
        return redirect()->route('admin.amenities');
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
        $amenity->delete();
        session()->flash('msg','Service has beed successfully deleted.');
        return redirect()->route('admin.amenities');
    }
}
