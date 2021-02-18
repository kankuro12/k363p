<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enquiry;
use App\Model\Vendor\Vendor;
use App\Model\Vendor\Review;
use App\Model\VendorUser\VendorUser;
use App\Model\Vendor\Amenity;
use App\Model\Vendor\Booking;
use App\VendorRequest;
use Route;
use \Carbon\Carbon;
use Tracker;
class DashboardController extends Controller
{
    public function index(){
    	$users=VendorUser::all();
        $vendors=Vendor::all();
        $amenities=Amenity::all();
        $reviews=Review::all();
        $recent_reviews=Review::where("created_at",">",Carbon::now()->subDay())->where("created_at","<",Carbon::now())->orderBy('created_at','desc')->take(7)->get();
        $recent_vendors=Vendor::where("created_at",">",Carbon::now()->subDay())->where("created_at","<",Carbon::now())->orderBy('created_at','desc')->take(7)->get();
        $recent_users=VendorUser::where("created_at",">",Carbon::now()->subDay())->where("created_at","<",Carbon::now())->orderBy('created_at','desc')->take(7)->get();
        $bookings=Booking::all();
    	return view('admin.dashboard',compact('users','vendors','amenities','reviews','recent_reviews','recent_vendors','recent_users','bookings'));
    }
    public function get_enquiries(){
        $enquiries=Enquiry::all();
        return view('admin.enquiries.index',compact('enquiries'));
    }

    public function requests(){
        $req=VendorRequest::where('accecpted',0)->get();
        $reqacc=VendorRequest::where('accecpted',1)->get();

        return view('admin.requests.index',compact('req','reqacc'));
    }
}
