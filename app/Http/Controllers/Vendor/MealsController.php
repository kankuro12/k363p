<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Model\Vendor\Meal;
use App\Model\Vendor\Vendor;
class MealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=Auth::user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $meals=$vendor->meals;
        if($request->ajax()){
          return view('vendor.meals.ajax.index',compact('meals'));            
        }
        return view('vendor.meals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=Auth::user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $validator=Validator::make($request->all(),[         
            'name.*' => 'required',
            'price.*'=>'required',
            'status.*'=>'required',
            
        ]);
        
        if ($validator->passes()) { 

            foreach($request->input('name') as $i => $name)
            {
                $data = new Meal();
                $data->name = $request->input('name')[$i];
                $data->status = $request->input('status')[$i];
                $data->price = $request->input('price')[$i];
                $data->vendor_id=$vendor->id;
                $data->save();
            }
 
            return response()->json([
                 'message' => 'Meal has been added successfully!!!.',
                 'success' => '1',
                 //'redirect_url'=>route('vendor.get_rooms')
             ], 200); 
            // session()->flash('msg','New Room has been added successfully.'); 
            // return redirect()->route('vendor.get_rooms');

        }        
        return response()->json(['errors' => $validator->errors()]);  
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
    public function edit(Request $request)
    {
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $meal=$vendor->meals()->where('id',request()->id)->firstOrFail();
        return view('vendor.meals.edit',compact('vendor','meal'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $user=Auth::user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $validator=Validator::make($request->all(),[         
          'name' => 'required',
          'price'=>'required',
          'status'=>'required',
          
        ]);
          
        if($validator->passes()){           
              $data=$vendor->meals()->where('id',$request->id)->firstOrFail();
              $data->name=$request->name;
              $data->status=$request->status;
              $data->price=$request->price;
              $data->save();      
          return response()->json([
               'message' => 'Meal has been updated successfully!!!.',
               'success' => '1',
           ], 200); 
        }        
        return response()->json(['errors' => $validator->errors()]);          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user=$request->user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $meal=$vendor->meals()->where('id',$request->id)->firstOrFail();
        $meal->delete();
        return response()->json(['message'=>'Meal has been removed successfully.','success'=>1]);
    }
}
