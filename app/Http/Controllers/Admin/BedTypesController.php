<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\BedType;
use File;
use App\FileUpload;
class BedTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bed_types=BedType::all();
        return view('admin.bed_types.index',compact('bed_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bed_types.create');
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
        $bed_type=new BedType();
        $bed_type->name=$request->name;
        $bed_type->status=$request->status;
        if($request->hasFile('icon')){
            $bed_type->icon=FileUpload::photo($request,'icon','','uploads/vendor/bed_type/icons',[[200,200]]);
        }
        $bed_type->save();
        session()->flash('msg','New Bed Type has beed successfully added.');
        return redirect()->route('admin.get_bed_type');
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
        $bed_type=BedType::where('slug',$slug)->firstOrFail();
        return view('admin.bed_types.edit',compact('bed_type'));
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
        $bed_type=BedType::where('slug',$slug)->firstOrFail();
        $bed_type->name=$request->name;
        $bed_type->status=$request->status;
        $bed_type->slug=null;
        if($request->hasFile('icon')){
            if(File::exists('uploads/vendor/bed_type/icons/'.$bed_type->icon) && $bed_type->icon!='icon.png'){
                unlink('uploads/vendor/bed_type/icons/'.$bed_type->icon);
                unlink('uploads/vendor/bed_type/icons/200x200/'.$bed_type->icon);
            }
            $bed_type->icon=FileUpload::photo($request,'icon','','uploads/vendor/bed_type/icons',[[200,200]]);
        }
        $bed_type->save();
        session()->flash('msg','Bed Type has beed successfully updated.');
        return redirect()->route('admin.get_bed_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $bed_type=BedType::where('slug',$slug)->firstOrFail();
        if(File::exists('uploads/vendor/bed_type/icons/'.$bed_type->icon) && $bed_type->icon!='icon.png'){
            unlink('uploads/vendor/bed_type/icons/'.$bed_type->icon);
            unlink('uploads/vendor/bed_type/icons/200x200/'.$bed_type->icon);
        }
        $bed_type->delete();
        session()->flash('msg','Bed Type has beed successfully deleted.');
        return redirect()->route('admin.get_bed_type');
    }
}
