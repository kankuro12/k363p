<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public $positions=[
        'Top Banner',
        'Middle Banner',
        'Bottom Banner',
        'Mobile Banner'
    ];
    public function index(){
        return view('admin.banner.index',['banners'=>Banner::where('id','>',0)->get()->groupBy('position'),'positions'=>$this->positions]);
    }

    public function add(Request $request){
        if($request->getMethod()=="POST"){
            $banner=new Banner();
            $banner->caption=$request->caption;
            $banner->position=$request->position;
            $banner->show_button=$request->show_button;
            $banner->button_text=$request->button_text;
            $banner->image=$request->image->store('uploads/banners/desktop');
            $banner->mobile_image=$request->mobile_image->store('uploads/banners/mobile');
            $banner->save();
            session()->flash('msg','Banner added successfully.');
            return redirect()->route('admin.banners');
        }else{
            return view('admin.banner.add',['positions'=>$this->positions]);

        }
    }

    public function edit(Banner $banner,Request $request){
        if($request->getMethod()=="POST"){
            
            $banner->caption=$request->caption;
            $banner->position=$request->position;
            $banner->show_button=$request->show_button;
            $banner->button_text=$request->button_text;
            if($request->hasFile('image')){

                $banner->image=$request->image->store('uploads/banners/desktop');
            }
            if($request->hasFile('mobile_image')){

                $banner->mobile_image=$request->mobile_image->store('uploads/banners/mobile');
            }
            $banner->save();
            session()->flash('msg','Banner Updated successfully.');
            return redirect()->route('admin.banners');
        }else{
            return view('admin.banner.edit',['banner'=>$banner,'positions'=>$this->positions]);

        }
    }

    public function del(Banner $banner){
        $banner->delete();
        session()->flash('msg','Banner Deleted successfully.');
        return redirect()->route('admin.banners');

    }
}
