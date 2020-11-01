<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\State;
use App\Model\Vendor\Country;
use Session;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states=State::paginate(100);
        return view('admin.state.index',compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries=Country::all();
        return view('admin.state.create',compact('countries'));
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
            'country_id'=>'required',
        ]);
        $input=$request->except('_token');
        State::create($input);
        Session::flash('msg','State added successfully !');
        return redirect()->route('admin.states');
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
        $state=State::find($id);
        $countries=Country::all();
        return view('admin.state.edit',compact('state','countries'));
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
           'country_id'=>'required',
       ]);
       $input=$request->except('_token');
       $state=State::find($id);
       $state->update($input);
       Session::flash('msg','State updated successfully !');
       return redirect()->route('admin.states');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::destroy($id);
        Session::flash('msg','State deletd successfully !');
        return redirect()->route('admin.states');
    }
    public function get_state_from_country($id){
        $states=State::where('country_id','=',$id)->get();
        return response()->json($states);
    }
}
