<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TourismArea;
use File;
use App\FileUpload;
use Session;
use Illuminate\Support\Facades\Input;
class TourismAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tourismareas=TourismArea::all();
        return view('admin.tourismarea.index',compact('tourismareas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tourismarea.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'featured_image'=>'required|image',
            'status'=>'required',
            'description'=>'required',
            'location'=>'required',
            'lat'=>'required',
            'lng'=>'required',
        ]);

        $input=$request->except(['_token']);

        if($request->hasFile('featured_image')){           
           $input['featured_image']=FileUpload::photo($request,'featured_image','','uploads/tourismareas',[[200,200],[800,800],[1200,1200]]);                     
        }else{
            $input['featured_image']='default.jpg';
        }
        $input['created_by']=auth()->guard('admin')->id();       
        TourismArea::create($input);
        Session::flash('message','New tourism area  is successfully added.');
        return redirect()->route('admin.get_tourisam_areas');
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
    public function edit($id)
    {
        $tr=TourismArea::find($id);
        return view('admin.tourismarea.edit',compact('tr'));
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
        $this->validate($request,[
            'name'=>'required',
            'featured_image'=>'image',
            'status'=>'required',
            'description'=>'required',
            'location'=>'required',
            'lat'=>'required',
            'lng'=>'required',
        ]);
        $tr=TourismArea::find($id);
        $input=$request->except(['_token']);
        if($request->hasFile('featured_image')){
            if(File::exists('uploads/tourismareas/'.$tr->featured_image)){
                unlink('uploads/tourismareas/'.$tr->featured_image);
                unlink('uploads/tourismareas/200x200/'.$tr->featured_image);
                unlink('uploads/tourismareas/800x800/'.$tr->featured_image);
                unlink('uploads/tourismareas/1200x1200/'.$tr->featured_image);
            }         
           $input['featured_image']=FileUpload::photo($request,'featured_image','','uploads/tourismareas',[[200,200],[800,800],[1200,1200]]);                         
        }        
        $tr->update($input);
        session()->flash('msg','TourismArea has beed successfully updated.');
        return redirect()->route('admin.get_tourisam_areas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tr=TourismArea::find($id);
        if(File::exists('uploads/tourismareas/'.$tr->featured_image)){
            unlink('uploads/tourismareas/'.$tr->featured_image);
            unlink('uploads/tourismareas/200x200/'.$tr->featured_image);
            unlink('uploads/tourismareas/800x800/'.$tr->featured_image);
            unlink('uploads/tourismareas/1200x1200/'.$tr->featured_image);
        }
        $tr->delete();
        session()->flash('msg','TourismArea has beed successfully deleted.');
        return redirect()->route('admin.get_tourisam_areas');

    }
   

}
