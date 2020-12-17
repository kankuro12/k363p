<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Model\Vendor\Vendor;
use App\Model\Vendor\Booking;
use App\Model\Vendor\Room;
use App\Model\Vendor\Country;
use App\Model\Vendor\Meal;
use App\Model\Vendor\BookingMeal;
use App\PaymentMethod;
use Illuminate\Support\Facades\Input;
use App\Notifications\Vendor\VendorNoti;
use Illuminate\Support\Facades\Notification;
use Mail;
use App\Traits\RGenerator;
use App\Model\Vendor\BookingPayment;
class BookingController extends Controller
{
    use RGenerator;


    public function bookings_start(Request $request,$vslug,$rslug){
       	$booking_details=$request->all();
    	$request->session()->forget('booking_details');
    	Session::put('booking_details',$booking_details);
        if(!Auth::check()){
            $next=url('user/login?next='.route('get_booking_process_start_step_1',['vslug'=>$vslug,'rslug'=>$rslug]));
            return redirect()->intended($next);
        }
    	return redirect()->route('get_booking_process_start_step_1',['vslug'=>$vslug,'rslug'=>$rslug]);
    }
    public function checkAvailabitlity(Request $request,$vslug,$rslug){
        $vendor=Vendor::where('slug',$vslug)->firstOrFail();
        $room=Room::where('slug',$rslug)->firstOrFail();
        $total_rooms=$room->no_of_rooms;
        $booking=Booking::where('room_id',$room->id)->get();
        $num_rooms=1;
        if($request->num_rooms){
            $num_rooms=$request->num_rooms;  
            $check_in_time=$request->check_in_time; 
            // $check_out_time=$request->check_out_time;
            $day=1;
            $b=Booking::where('booking_status','!=','completed')->where('booking_status','!=','rejected')->where('room_id',$room->id)->whereBetween('check_in_time', [$check_in_time, $check_out_time])->WhereBetween('check_out_time', [$check_in_time, $check_out_time])->sum('num_rooms');

            $avaialbe=$total_rooms-$b;          
            if($avaialbe<$request->num_rooms){
                return view('public.room.notAvailable');
            }
        }
        $price=$room->getNewPrice()*$num_rooms*$day;
        return view('public.room.form',compact('room','vendor','num_rooms','price'));
    }
    public function get_booking_process_start_step_1(Request $request,$vslug,$rslug){
        // dd($request);
        $user=Auth::user();
        $details=Session::get('booking_details');
        $countries=Country::all();
        $hotel_detail=Vendor::where('slug',$vslug)->first();
        $room=Room::where('slug',$rslug)->first();
        $check_in_time=$details['check_in_time'];
        // $check_out_time=$details['check_out_time']; 
        // $days=Carbon::parse($check_out_time)->diffInDays(Carbon::parse($check_in_time));
        // $price=$room->getNewPrice()*$details['num_rooms']*$days;
        // $meals=$hotel_detail->meals;
        $pmethods=PaymentMethod::where('status','active')->get();

        // $details['price']=$price;
        // $details['bed_price']=0;
        // $details['num_of_adults']=0;
        // $details['num_of_childs']=0;
        // foreach ($details['adults'] as $key => $adult) {
        //     $details['num_of_adults']+=$adult;
        // }
        // if($details['childs']){
        //     foreach ($details['childs'] as $key => $child) {
        //         $details['num_of_childs']+=$child;
        //     }
        // }    

        $khalti=PaymentMethod::where('pkey','khalti')->first();       

        return view('public.booking.index1',compact('user','hotel_detail','room','pmethods','khalti','check_in_time'));
    }
    public function booking_process_start_step_2(Request $request,$provider=null,$token=null,$idx=null){
        $validator=Validator::make($request->all(),[
            'room' => 'required',
            'check_in_time' => 'required', 
            'check_out_time' => 'required',            
            'num_rooms'=>'required',
            'fname'=>'required|string',
            'lname'=>'required|string',
            'email'=>'required|email',
            'pnumber'=>'required',
            'city_id'=>'required',
            'price'=>'required',
        ]);
        $room_id=$request->room_id;
        $check_in_time=$request->check_in_time;
        $check_out_time=$request->check_out_time;
        $adult=$request->adult;
        $children=$request->children;
        $num_rooms=$request->num_rooms;
        $fname=$request->fname;
        $lname=$request->lname;
        $email=$request->email;
        $pnumber=$request->pnumber;
        $city_id=$request->city_id;
        $pmethod=$request->pmethod;
        $price=$request->price;
        $additionalinfo=$request->additionalinfo;

        $booking=new Booking();
        $booking->room_id=$room_id;
        $booking->check_in_time=$check_in_time;
        $booking->check_out_time=$check_out_time;
        $booking->adult=$adult;
        $booking->children=$children;
        $booking->num_rooms=$num_rooms;
        $booking->new_price=$price;
        $booking->first_name=$fname;
        $booking->last_name=$lname;
        $booking->email=$email;
        $booking->phone_number=$pnumber;
        $booking->user_id=Auth::user()->vendoruser->id;
        $booking->payment_addition_info=$additionalinfo;
        $booking->type=$request->pmethod;
        $booking->vendor_id=$request->vendor_id;
        $booking->booking_id=$this->generate_code();
        if($provider){
            $booking->payment_status='paid';
        }
        $booking->save();
        if($booking->type==2){
            $bp=new BookingPayment();
            $bp->booking_id=$booking->id;
            $bp->type='online';
            $bp->provider=$provider;
            $bp->token=$token;
            $bp->voucher=$idx;
            $bp->overall='test';
            $bp->status=1;
            $bp->save();
        }
        $meal_price=0;
        if($request->input('meal_id')){
            foreach($request->input('meal_id') as $i => $meal)
            {
                $meal_id = $request->input('meal_id')[$i];
                $meal_value = $request->input('meal_value')[$i];
                $meal=Meal::find($meal_id);
                if($meal_value>0){
                    $meal_price+=$meal->price;            
                    $bmeal=new BookingMeal();
                    $bmeal->meal_id=$meal_id;
                    $bmeal->meal_price=$meal->price;
                    $bmeal->booking_id=$booking->id;
                    $bmeal->meal_value=$meal_value;
                    $bmeal->over_all="test";
                    $bmeal->save();
                }
            }
        }
        $request->session()->forget('booking_details');
        $redirect_url=route('user.show_bookings',['id'=>$booking->booking_id]);


        //send mail to vendor
        $notification['title']=$fname." ".$lname." has booked your room ";
        $notification['detail']=$fname." ".$lname." has booked your room at ".$booking->created_at;
        $notification['link']='';
        $notification['id']=$booking->booking_id;
        $notification['data']='';
        $notification['oid']=$booking->id;
        $when = now()->addSeconds(5);        
        $booking->vendor->user->notify((new VendorNoti($notification))->delay($when));

        return response()->json(['msg'=>'successfully booked','success'=>1,'redirect_url'=>$redirect_url]);
    }
    public function pay_with_khalti(Request $request){
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
        $idx=$response->idx;        
        $provider='khalti';
        return $this->booking_process_start_step_2($request,$provider,$token,$idx);
        // return response()->json(['msg'=>'successfully booked','success'=>1,'redirect_url'=>'/']);

    }


}
