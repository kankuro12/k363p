<?php

namespace App\Http\Controllers\Need;

use App\Http\Controllers\Controller;
use App\Model\Vendor\Booking;
use App\Model\Vendor\BookingPayment;
use Illuminate\Http\Request;

use App\Model\Vendor\Vendor;
use App\Model\Vendor\Room;
use App\Model\Vendor\RoomType;
use App\Model\Vendor\Review;
use DB;
use App\TourismArea;
use App\Model\Vendor\State;
use App\Model\Vendor\Country;
use App\Model\Vendor\City;
use App\Model\Vendor\Location;
use App\Model\Vendor\Collection;
use App\Model\VendorUser\VendorUser;
use App\Notifications\User\SignupActivate;
use App\Notifications\Vendor\VendorNoti;
use App\PaymentMethod;
use App\User;
use illuminate\Support\Facades\Auth;
use App\Traits\RGenerator;

class BookingController extends Controller
{

    use RGenerator;

    public function start(Request $request){

        if($request->getMethod()=="POST"){
            session(['date'=>$request->start_date,'room_id'=>$request->room_id]);
            if(!Auth::check()){
                session(['redirect'=>route('n.startbooking')]);
                return redirect()->route('n.user.login');
            }
            $date=$request->start_date;
            $room_id=$request->room_id;

        }else{
            if(!Auth::check()){
                session(['redirect'=>route('n.startbooking')]);
                return redirect()->route('n.user.login');
            }

            if(session('date')==null || session('room_id')==null){
                return redirect()->route('n.home');
            }
            $date=session('date');
            $room_id=session('room_id');

        }

        $room=Room::find($room_id);
        $user=Auth::user();
        $data=$user->vendoruser;
        $khalti=PaymentMethod::where('pkey','khalti')->first();
        $pmethods=PaymentMethod::where('status','active')->get();

        // dd(compact('date','room_id'));
        return view('themes.needtech.vendor.service.booking',compact('pmethods','date','room_id','room','khalti','user'));
    }

    public function final(Request $request){

        if($request->getMethod()=="POST"){
            session(['date'=>$request->start_date,'room_id'=>$request->room_id]);
            if(!Auth::check()){
                session(['redirect'=>route('n.startbooking')]);
                return redirect()->route('n.user.login');
            }
            $date=$request->start_date;
            $room_id=$request->room_id;

        }else{
            if(!Auth::check()){
                session(['redirect'=>route('n.startbooking')]);
                return redirect()->route('n.user.login');
            }

            if(session('date')==null || session('room_id')==null){
                return redirect()->route('n.home');
            }
            $date=session('date');
            $room_id=session('room_id');

        }

        $room=Room::find($room_id);
        $user=Auth::user();
        $data=$user->vendoruser;
        // dd(compact('date','room_id'));
        return view('themes.needtech.vendor.service.booking',compact('date','room_id','room'));
    }

    public function verifyBooking(Request $request){
        $khalti=PaymentMethod::where('pkey','khalti')->first();
        $user=Auth::user()->vendoruser;
        $amount=$request->amount;
        $token=$request->token;
        $args = http_build_query(array(
            'token' => $token,
            'amount'  =>$amount
        ));

        $url = "https://khalti.com/api/payment/verify/";
        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $key=$khalti->mode=='live'?$khalti->live_secret_key:$khalti->test_secret_key;

        $headers = ['Authorization: Key '.$key];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response=json_decode($response);
        // $idx=$response->idx;
        // $provider='khalti';
        $verified=false;
        // dd(property_exists('response', 'state'));
        if(isset($response->state)){

            if(isset($response->state->template)){

                if($response->state->template=="is complete"){
                    $verified=true;

                }
            }
        }

        return response()->json(['verified'=>$verified]);

    }

    public function book(Request $request){
        // dd($request->all());

        $room=Room::find($request->room_id);
        $booking=new Booking();
        $booking->check_in_time=session('date');

        $booking->new_price=$request->price;
        $booking->first_name=$request->fname;
        $booking->last_name=$request->lname;
        $booking->email=$request->email;
        $booking->room_id=$request->room_id;
        $booking->phone_number=$request->pnumber;
        $booking->user_id=Auth::user()->vendoruser->id;
        $booking->payment_addition_info=$request->additionalinfo;
        $booking->type=$request->pmethod;
        $booking->vendor_id=$room->vendor->id;
        $booking->booking_id=$this->generate_code();
        $booking->save();


        if($booking->type==2){
            $data=json_decode($request->extrainfo);
            $bp=new BookingPayment();
            $bp->booking_id=$booking->id;
            $bp->type='online';
            $bp->provider="Khalti";
            $bp->token=$data->token;
            $bp->voucher=$data->idx;
            $bp->overall=$request->extrainfo;
            $bp->status=1;
            $bp->save();
        }
        $redirect_url=route('n.user.singlebooking',$booking->booking_id);


        //send mail to vendor
        $notification['title']=$request->fname." ".$request->lname." has booked your room ";
        $notification['detail']=$request->fname." ".$request->lname." has booked your room at ".$booking->created_at;
        $notification['link']='';
        $notification['id']=$booking->booking_id;
        $notification['data']='';
        $notification['oid']=$booking->id;
        $when = now()->addSeconds(5);
        $booking->vendor->user->notify((new VendorNoti($notification))->delay($when));
        return redirect()->route('n.user.singlebooking',$booking->booking_id);
    }
}
