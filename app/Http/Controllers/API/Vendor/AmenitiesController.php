<?php

namespace App\Http\Controllers\API\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Vendor;
class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $amenities=$vendor->amenities;
        return response()->json($amenities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $vendor->amenities()->sync($request->amenity_id);
        return response()->json(['msg'=>'Amenities Created!'],201);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $vendor->amenities()->sync($request->amenity_id);
        return response()->json(['msg'=>'Amenities Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
