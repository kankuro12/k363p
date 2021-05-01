<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\RoomType;
use File;
use App\FileUpload;
class RoomTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_types=RoomType::all();
        return view('admin.room_types.index',compact('room_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.room_types.create');
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
        $room_type=new RoomType();
        $room_type->name=$request->name;
        $room_type->status=$request->status;
        if($request->hasFile('icon')){
            $room_type->icon=$request->icon->store('uploads/vendor/room_type/icons');
        }
        $room_type->save();
        session()->flash('msg','New Package Type has beed successfully added.');
        return redirect()->route('admin.get_room_type');
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
        $room_type=RoomType::where('slug',$slug)->firstOrFail();
        return view('admin.room_types.edit',compact('room_type'));
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
        $room_type=RoomType::where('slug',$slug)->firstOrFail();
        $room_type->name=$request->name;
        $room_type->status=$request->status;
        $room_type->slug=null;
        if($request->hasFile('icon')){
            if(File::exists($room_type->icon) && $room_type->icon!='icon.png'){
                unlink($room_type->icon);
            }
            $room_type->icon=$request->icon->store('uploads/vendor/room_type/icons');
           
        }
        $room_type->save();
        session()->flash('msg','Package Type has beed successfully updated.');
        return redirect()->route('admin.get_room_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $room_type=RoomType::where('slug',$slug)->firstOrFail();
        if(File::exists($room_type->icon) && $room_type->icon!='icon.png'){
            unlink($room_type->icon);
        }
        $room_type->delete();
        session()->flash('msg','Package Type has beed successfully deleted.');
        return redirect()->route('admin.get_room_type');
    }
}
