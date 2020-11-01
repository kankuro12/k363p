<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Room;
use Auth;
use \Carbon\Carbon;
class DashboardController extends Controller
{
    public function index(){
    	$vendor=Auth::user()->vendor;
    	$rooms=$vendor->rooms;
    	$recent_reviews=$vendor->reviews()->where("created_at",">",Carbon::now()->subDay())->where("created_at","<",Carbon::now())->orderBy('created_at','desc')->take(7)->get();
    	$recent_bookings=$vendor->bookings()->where("created_at",">",Carbon::now()->subDay())->where("created_at","<",Carbon::now())->orderBy('created_at','desc')->take(7)->get();
    	return view('vendor.dashboard.index',compact('rooms','vendor','recent_reviews','recent_bookings'));
    }
    public function get_notification($id){
        $data=Auth::guard()->user()->notifications()->where('id',$id)->firstOrFail();
        $data->markAsRead();
        return view('vendor.notification.notification',['data'=>$data]);
    }
    public function get_notifications(){
        $data=Auth::guard()->user()->notifications()->orderBy('created_at','desc')->paginate(4);
        return view('vendor.notification.notifications',['data'=>$data]);
    }
}
