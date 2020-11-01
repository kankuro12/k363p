<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\State;
use App\Model\Vendor\City;
use App\Model\Vendor\Country;
use Session;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities=City::paginate(50);
        return view('admin.city.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states=State::all();
        $countries=Country::all();
        return view('admin.city.create',compact('states','countries'));
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
            'state_id'=>'required',
        ]);
        $input=$request->only('name','state_id');
        City::create($input);
        Session::flash('msg','City added successfully !');
        return redirect()->route('admin.city');
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
        $city=City::find($id);
        $countries=Country::all();
        $states=State::all();
        return view('admin.city.edit',compact('city','countries','states'));
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
           'state_id'=>'required',
       ]);
       $input=$request->except('_token','country_id');
       $city=City::find($id);
       $city->update($input);
       Session::flash('msg','City updated successfully !');
       return redirect()->route('admin.city');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::destroy($id);
        Session::flash('msg','City deletd successfully !');
        return redirect()->route('admin.city');
    }
}
