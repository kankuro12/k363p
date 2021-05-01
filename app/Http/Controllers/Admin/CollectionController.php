<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Collection;
use App\Model\Vendor\CollectionVendor;
use App\Model\Vendor\Vendor;
use Session;
use DB;
use File;
use App\FileUpload;
class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections=Collection::all();
        return view('admin.collections.index',compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.collections.create');
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
            'status'=>'required',
            'image'=>'image',
        ]);
        $collection=new Collection();
        $collection->name=$request->name;
        $collection->status=$request->status;
        $collection->description=$request->description;
        if($request->hasFile('image')){
            $collection->image=$request->image->store('uploads/vendor/collections/');
        }
        $collection->save();
        Session::flash('msg','New Collection has been added successfully.');
        return redirect()->route('admin.collections');
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
        $collection=Collection::find($id);
        return view('admin.collections.edit',compact('collection'));
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
            'status'=>'required',
            'image'=>'image',
        ]);
        $collection=Collection::find($id);
        $collection->name=$request->name;
        $collection->status=$request->status;
        $collection->description=$request->description;
        if($request->hasFile('image')){
            if(File::exists($collection->image)){
                unlink($collection->image);
            }
            $collection->image=$request->image->store('uploads/vendor/collections/');
        }
        $collection->save();
        Session::flash('msg','Collection has been updated successfully.');
        return redirect()->route('admin.collections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection=Collection::find($id);
        if(File::exists($collection->image)){
            unlink($collection->image);
        }
        $collection->delete();
        Session::flash('msg','Collection has been deleted successfully.');
        return redirect()->route('admin.collections');
    }
    public function manage_product($id){
        $collection=Collection::find($id);
        $collectionvendors=$collection->collectionvendors;

        $vids= DB::table('collection_vendors')->where('collection_id',$id)->pluck('vendor_id');

        $vendors=Vendor::where('verified',1)->get()->whereNotIn('id',$vids);


        return view('admin.collections.manage_vendor',compact('collection','vendors','collectionvendors'));
    }
    public function post_manage_product(Request $request,$id){
        $this->validate($request,[
            'vendor_id'=>'required',
        ]);
        $vendor_id=$request->vendor_id;
        $vendorcollection=new CollectionVendor();
        $vendorcollection->vendor_id=$vendor_id;
        $vendorcollection->collection_id=$id;
        $vendorcollection->save();
        Session::flash('msg','Vendor has been successfully added.');
        return redirect()->back();
    }
    public function delete_product($id){
        $vendorcollection=CollectionVendor::find($id);
        $vendorcollection->delete();
        Session::flash('msg','Vendor has been successfully removed from the collection.');
        return redirect()->back();
    }
}
