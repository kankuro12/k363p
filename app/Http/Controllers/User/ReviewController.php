<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Model\VendorUser\VendorUser;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $user=VendorUser::where('user_id',$user->id)->firstOrFail(); 
        $reviews=$user->reviews()->paginate(2);
        $to_reviewed=$user->bookings()->where('bookings.booking_status','completed')->whereDoesntHave('review')->get();


        
        

        


        return view('user.review.index',compact('reviews','user','to_reviewed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
           'vendor_id'=>'required',
           'booking_id'=>'required',
           'booking_id'=>'required',
           'review_title'=>'required',
           'review_description'=>'required',
           'staff_behaviour'=>'required',
           'clean'=>'required',
           'food'=>'required',
           'comfort'=>'required',
           'facility'=>'required'            
        ]);
        
        if ($validator->passes()) {
            $user=Auth::user();
            $user=VendorUser::where('user_id',$user->id)->firstOrFail(); 

            $user->reviews()->create([
                'review_title'=>$request->review_title,
                'review_description'=>$request->review_description,
                'clean'=>$clean=$request->clean,
                'food'=>$food=$request->food,
                'comfort'=>$comfort=$request->comfort,
                'facility'=>$facility=$request->facility,
                'sbehaviour'=>$sbehaviour=$request->staff_behaviour,
                'vendor_id'=>$request->vendor_id,
                'booking_id'=>$request->booking_id,
                'avg_rating'=>($clean+$food+$facility+$comfort+$sbehaviour)/5,
            ]);  
            return redirect()->back()->withMsg('You have been successfully reviewed!!!');                   
            // return response()->json([
            //      'message' => 'You have been successfully reviewed!!!.','success' => '1','list_id'=>$request->booking_id
            // ], 200);

        }        
        return redirect()->back()->withError($validator->errors());
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
