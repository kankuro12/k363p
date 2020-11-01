<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Category;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.vcategories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vcategories.create');
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
            'name' => 'required|string',
            'status'=>'required',
        ]);
        $category = new Category([
            'name' => $request->name,
            'status' => $request->status,
            'description'=>$request->description
        ]);
        $category->save();
        session()->flash('msg','New Vendor Category has beed successfully added.');
        return redirect()->route('admin.categories');
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
        $category=Category::where('slug',$slug)->firstOrFail();
        return view('admin.vcategories.edit',compact('category'));
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
            'status'=>'required'
        ]);
        $category=Category::where('slug',$slug)->first();
        $category->name=$request->name;
        $category->status=$request->status;
        $category->description=$request->description;
        $category->slug = null;
        $category->save();
        session()->flash('msg','Vendor Category has beed successfully updated.');
        return redirect()->route('admin.categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category=Category::where('slug',$slug)->first();
        $category->delete();
        session()->flash('msg','Vendor Category has beed successfully deleted.');
        return redirect()->route('admin.categories');
    }
}
