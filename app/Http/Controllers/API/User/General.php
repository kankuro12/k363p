<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Model\Vendor\Booking;
use App\Model\Vendor\BookingPayment;
use App\Model\Vendor\Collection;
use App\Model\Vendor\Location;
use App\Model\Vendor\Review;
use App\Model\Vendor\Room;
use App\Model\Vendor\RoomType;
use App\Model\Vendor\Vendor;
use App\Notifications\Vendor\VendorNoti;
use App\Traits\RGenerator;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class General extends Controller
{
    use RGenerator;
    //
    public function info(){
        $user=Auth::user();
        $user->vendoruser;
        return response()->json(['status'=>true,'user'=>$user]);
    }

    public function checkout(Request $request){
        $room=Room::find($request->room_id);
        $booking=new Booking();
        $booking->new_price=$request->price;
        $booking->first_name=$request->fname;
        $booking->last_name=$request->lname;
        $booking->email=$request->email;
        $booking->room_id=$request->room_id;
        $booking->phone_number=$request->phone;
        $booking->user_id=Auth::user()->vendoruser->id;
        $booking->payment_addition_info=$request->additionalinfo;

        //booking type 1-payment on driving center 2-online payment
        $booking->type=$request->type;

        $booking->vendor_id=$request->vendor_id;
        $booking->booking_id=$this->generate_code();
        $booking->save();


        if($booking->type==2){
            
            $bp=new BookingPayment();
            $bp->booking_id=$booking->id;
            $bp->type='online';
            $bp->provider="Khalti";
            $bp->token=$request->token;
            $bp->voucher=$request->idx;
            $bp->overall=$request->extrainfo;
            $bp->status=1;
            $booking->payment_status="paid";
            $bp->save();
        }
        


        //send mail to vendor
        $notification['title']=$request->fname." ".$request->lname." has booked your room ";
        $notification['detail']=$request->fname." ".$request->lname." has booked your room at ".$booking->created_at;
        $notification['link']='';
        $notification['id']=$booking->booking_id;
        $notification['data']='';
        $notification['oid']=$booking->id;
        $when = now()->addSeconds(5);
        $vendor=Vendor::find($booking->vendor_id);
        $vendor->user->notify((new VendorNoti($notification))->delay($when));
        return response()->json(['status'=>true,'booking_id'=> $booking->booking_id]);
    }
    public function bookings(){
        $user=Auth::user()->vendoruser->id;
        $bookings=[];
        foreach(Booking::where('user_id',Auth::user()->vendoruser->id)->get() as $booking){
            $booking->payment=\App\Model\Vendor\BookingPayment::where('booking_id',$booking->id)->first();
            array_push($bookings,$booking);
        }
        return response()->json(['status'=>true,'bookings'=>$bookings]);
    }
    public function reviews(){
        $user=Auth::user()->vendoruser->id;
        foreach(Booking::where('user_id',Auth::user()->vendoruser->id)->get() as $booking){
            $booking->payment=\App\Model\Vendor\BookingPayment::where('booking_id',$booking->id)->first();
            array_push($bookings,$booking);
        }
        return response()->json(['status'=>true,'bookings'=>$bookings]);

    }
    public function SingleBooking($code){
        // dd($code);
        $booking=Booking::where('booking_id',$code)->first();
        $bookingpayment=\App\Model\Vendor\BookingPayment::where('booking_id',$booking->id)->first();
        return response()->json(['status'=>true,'booking'=>$booking,'payment'=>$bookingpayment]);
    }
}
