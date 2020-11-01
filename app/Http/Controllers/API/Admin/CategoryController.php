<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::latest()->paginate(10);
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
            'status'=>'required'
        ]);
        $category = new Category([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        $category->save();
        session()->flash('msg','New Vendor Category has beed successfully added.');
        return response()->json([
            'message' => 'Successfully created category!'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category=Category::where('slug',$slug)->first();
        return response()->json($category);
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
        $category->slug = null;
        $category->save();
        return response()->json($category);


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
        return response()->json(['msg'=>'Category is deleted.']);
    }
}
