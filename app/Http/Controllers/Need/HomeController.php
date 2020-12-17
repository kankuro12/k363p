<?php

namespace App\Http\Controllers\Need;

use App\Http\Controllers\Controller;
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
// use App\Model\Vendor\Room;
use App\Enquiry;

class HomeController extends Controller
{
    public function index()
    {
        $featured_vendors = Vendor::where(['featured' => 'active', 'verified' => 1])->take(8)->inRandomOrder()->latest()->get();
        $trs = Room::all();
        $roomtypes=RoomType::all();
        // $popular_vendors = Vendor::leftJoin('reviews', 'reviews.vendor_id', '=', 'vendors.id')
        //     ->select(array(
        //         'vendors.*',
        //         DB::raw('SUM(avg_rating) as ratings_average')
        //     ))
        //     ->groupBy('id')
        //     ->orderBy('ratings_average', 'DESC')
        //     ->take(8)
        //     ->get();
            // dd($popular_vendors);
        $collections = Collection::where('status', 1)->get();

        // return view('public.home',compact('featured_vendors','trs','popular_vendors','collections'));

        return view('themes.needtech.home.index',compact('roomtypes','featured_vendors','trs','collections'));
    }
}
