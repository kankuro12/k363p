<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Vendor\Collection;
use App\Model\Vendor\Location;
use App\Model\Vendor\Review;
use App\Model\Vendor\Room;
use App\Model\Vendor\RoomType;
use App\Model\Vendor\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homePage(){
        $fvs = Vendor::where(['featured' => 'active', 'verified' => 1])->select('id','name','star',)->take(8)->inRandomOrder()->latest()->get();
        $featured_vendors=[];
        foreach ($fvs as $key => $value) {
            $value->reviewcount=Review::where('vendor_id',$value->id)->count();
            $value->servicecount=Room::where('vendor_id',$value->id)->count();
            $value->location=Location::where('vendor_id',$value->id)->first();
            array_push($featured_vendors,$value);
        }
        // foreach ($variable as $key => $value) {
        //     # code...
        // }
        $trs = Room::inRandomOrder()->limit(8)->get();
        $roomtypes=RoomType::all();
        // $cities=City::take(5)->get();
        $popular_vendors = Vendor::leftJoin('reviews', 'reviews.vendor_id', '=', 'vendors.id')
            ->select(array(
                'vendors.*',
                DB::raw('SUM(avg_rating) as ratings_average')
            ))
            ->groupBy('id')
            ->orderBy('ratings_average', 'DESC')
            ->take(8)
            ->get();
        $collections = Collection::where('status', 1)->get();
        return response()->json([
            'status'=>true,
            'featured_vendors'=>$fvs,
            'rooms'=>$trs,
            'popular_vendors'=>$popular_vendors,
            'collections'=>$collections
        ]);
    }   
}
