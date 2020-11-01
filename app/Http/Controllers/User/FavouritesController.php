<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Model\VendorUser\VendorUser;
use App\Model\VendorUser\Favourite;
class FavouritesController extends Controller
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
        $favs=$user->favourites;
        return view('user.favourite.index',compact('favs','user'));
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
        $validator=Validator::make($request->all(),[
            'vendor_id' => 'required|integer',            
        ]);
        
        if ($validator->passes()) {
            $user=Auth::user();
            $user=VendorUser::where('user_id',$user->id)->firstOrFail();  
            


            $favourite=Favourite::where([
                'vendor_id'=>$request->vendor_id,
                'vendor_user_id'=>$user->id
            ])->first();

            if($favourite){
                $favourite->delete();
                $msg="Vendor has been successfully removed from favourite list.";
                $bookmarked=false;
            }else{
                Favourite::create([
                    'vendor_user_id'=>$user->id,
                    'vendor_id'=>$request->vendor_id
                ]);
                $msg="Vendor has been successfully added to favourite list.";
                $bookmarked=true;
            }
            


            return response()->json([
                 'message' =>$msg,'success' => '1','bookmarked'=>$bookmarked
            ], 200);

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
        $user=Auth::user();
        $user=VendorUser::where('user_id',$user->id)->firstOrFail(); 
        $favourite=Favourite::where([
            'id'=>$id,
            'vendor_user_id'=>$user->id
        ])->first();
        $favourite->delete();
        return redirect()->back()->with('msg','Removed from favourite list.');
    }
}
