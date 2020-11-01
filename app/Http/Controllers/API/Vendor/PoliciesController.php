<?php

namespace App\Http\Controllers\API\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Vendor;
use App\Model\Vendor\Policy;
class PoliciesController extends Controller
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
        $policies=$vendor->policy;
        return response()->json($policies);
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
            'check_in_out_policy'=>'required',
            'cancelation_policy'=>'required',
            'extra_bed_policy'=>'required',
            'payment_mode'=>'required',
            'status'=>'required',
            'description'=>'string',
        ]);
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $input=$request->only('check_in_out_policy','cancelation_policy','extra_bed_policy','payment_mode','status','description');
        $input['vendor_id']=$vendor->id;
        $policy =Policy::updateOrCreate(['vendor_id' =>$vendor->id],$input);
        return response()->json($policy);
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
        //
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
