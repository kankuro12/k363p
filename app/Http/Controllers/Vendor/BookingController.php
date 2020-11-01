<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Vendor\Booking;
use App\Model\Vendor\BookingChildRoom;
use App\Model\Vendor\Room;
use Mail;
use App\Mail\ResponseToUser;

use App\Notifications\VendorUser\UserNoti;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Input;
use DB;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor=Auth::user()->vendor;
        $bookings=Booking::where('vendor_id',$vendor->id)->get();
        return view('vendor.bookings.index',compact('bookings'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor=Auth::user()->vendor;
        $booking=Booking::where(['vendor_id'=>$vendor->id,'id'=>$id])->firstOrFail();
        $room=Room::find($booking->room_id);

        //checking booked child rooms        

        $brooms=Booking::where('booking_status','confirmed')->pluck('id');

        $nrooms=BookingChildRoom::whereIn('booking_id', $brooms)->pluck('child_rooms_id');

        $bcrooms=$room->childrooms()->whereNotIn('id',$nrooms)->get(); 


        return view('vendor.bookings.show',compact('booking','bcrooms'));
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
        $this->validate($request,[
            'booking_status'=>'required',
            'payment_status'=>'required',
            'croom_id.*'=>'required',
        ]);
        $vendor=Auth::user()->vendor;
        $booking=Booking::where(['id'=>$id,'vendor_id'=>$vendor->id])->firstOrFail();
        $booking->payment_status=$request->payment_status;
        $booking->booking_status=$request->booking_status;
        $booking->save();

        //Add to booking child room table
        if($request->input('croom_id')){
            foreach($request->input('croom_id') as $i => $croom)
            {
                $data = BookingChildRoom::firstOrNew(array('booking_id' =>$booking->id,'child_rooms_id'=>$request->input('croom_id')[$i]));
                $data->child_rooms_id = $request->input('croom_id')[$i];
                $data->booking_id=$booking->id;
                $data->save();
            }
        }

        /*

        $user=$booking->vendoruser->user;
        $notification['title']="Bookig has been ".$booking->booking_status;
        $notification['detail']='';
        $notification['link']=route('user.show_bookings',['id'=>$booking->id]);
        $when = now()->addSeconds(5);        
        $user->notify((new UserNoti($notification)));

        */

        session()->flash('msg','Booking Details has been updated');
        return redirect()->back();
        
    }
    public function destroy($id)
    {
        //
    }
   public function confirm($id){
        $vendor=Auth::user()->vendor;
        $booking=Booking::where('id',$id)->firstOrFail();
        if($booking->vendor_id==$vendor->id){
            $booking->booking_status='confirmed';
            $booking->save();
            $notification['title']="Bookig has been ".$booking->booking_status;
            $notification['detail']=$booking->vendor->name." has ".$booking->booking_status." your booking for ".$booking->vendor->name."(".$booking->room->name.")";
            $notification['data']=$booking;
            $notification['id']=$booking->id;
            $notification['link']=route('user.show_bookings',['id'=>$booking->booking_id]);
            $when = now()->addSeconds(5);        
            $booking->vendoruser->user->notify((new UserNoti($notification)));
        }
        return redirect()->back();
    }
    public function reject($id){
        $vendor=Auth::user()->vendor;
        $booking=Booking::where('id',$id)->firstOrFail();
        if($booking->vendor_id==$vendor->id){
            $booking->booking_status='rejected';
            $booking->save();
            Mail::to($booking->email)->send(new ResponseToUser($booking));
        }
        return redirect()->back();
    }
    public function complete_payment($id){
        $vendor=Auth::user()->vendor;
        $booking=Booking::where('id',$id)->firstOrFail();
        if($booking->vendor_id==$vendor->id){
            $booking->payment_status='paid';
            $booking->save();
            Mail::to($booking->email)->send(new ResponseToUser($booking));
        }
        return redirect()->back();
    }
    public function complete_booking($id){
        $vendor=Auth::user()->vendor;
        $booking=Booking::where('id',$id)->firstOrFail();
        if($booking->vendor_id==$vendor->id){
            $booking->booking_status='completed';
            $booking->save();
            //send mail
        }
        return redirect()->back();        

    }
    
}
