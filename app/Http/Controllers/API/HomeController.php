<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Vendor\Booking;
use App\Model\Vendor\City;
use App\Model\Vendor\Collection;
use App\Model\Vendor\Location;
use App\Model\Vendor\Review;
use App\Model\Vendor\Room;
use App\Model\Vendor\RoomAmentiy;
use App\Model\Vendor\RoomPhoto;
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
            $value->location=Location::where('vendor_id',$value->id)->select('name')->first()->name;
            array_push($featured_vendors,$value);
        }
        // foreach ($variable as $key => $value) {
        //     # code...
        // }
        $trs = Room::join('room_types','rooms.roomtype_id','=','room_types.id')->join('vendors','rooms.vendor_id','=','vendors.id')->select('rooms.description','rooms.id','rooms.name','rooms.price','rooms.discount',DB::raw('room_types.name as roomtype'),DB::raw('vendors.name as vendor'))->inRandomOrder()->limit(8)->get();
        $featured_services=[];
        foreach ($trs  as  $value) {
            $value->newprice=$value->getNewPrice();
            $value->images=RoomPhoto::where('room_id',$value->id)->pluck('image');
            array_push($featured_services,$value);
        }
        //delta test123   

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
            'featured_vendors'=>$featured_vendors,
            'services'=>$featured_services,
            'packagetypes'=>$roomtypes,
            'popular_vendors'=>$popular_vendors,
            'collections'=>$collections
        ]);
    }   

    public function singleVendor(Vendor $vendor){
        $rs=Room::join('room_types','rooms.roomtype_id','=','room_types.id')->select('rooms.description','rooms.id','rooms.name','rooms.price','rooms.discount',DB::raw('room_types.name as roomtype'))->where('rooms.vendor_id',$vendor->id)->get();
        $rooms=[];
        foreach ($rs as  $value) {
            $value->amenities=RoomAmentiy::where('room_id',$value->id)->pluck('amenity');
            $value->images=RoomPhoto::where('room_id',$value->id)->pluck('image');

            array_push($rooms,$value);
        }
        $reviews=Review::where('vendor_id',$vendor->id)->select('id',DB::raw('vendor_user_id as user_id'),'review_title','review_description',DB::raw('avg_rating as rating'))->get();
        return response()->json(['status'=>true,'vendor'=>$vendor,'packages'=>$rooms,'reviews'=>$reviews]);
    }

    public function singlePackage(Room $package){
        $package->vendor=Vendor::find($package->vendor_id)->name;
        $package->newprice=$package->getNewPrice();
        $package->amenities=RoomAmentiy::where('room_id',$package->id)->pluck('amenity');
        $package->images=RoomPhoto::where('room_id',$package->id)->pluck('image');
        $package->bookingcount=Booking::where('room_id',$package->id)->count();
        return response()->json(['status'=>true,'package'=>$package]);
    }
    public function cities(){
        return response()->json(['status'=>true,'cities'=>City::all()]);
    }

    public function packageType(RoomType $packageType){
        $packages=Room::where('roomtype_id',$packageType->id)->get();
        $trs = Room::join('vendors','rooms.vendor_id','=','vendors.id')->select('rooms.description','rooms.id','rooms.name','rooms.price','rooms.discount',DB::raw('vendors.name as vendor'))->where('rooms.roomtype_id',$packageType->id)->get();
        $packages=[];
        foreach ($trs  as  $value) {
            $value->newprice=$value->getNewPrice();
            $value->images=RoomPhoto::where('room_id',$value->id)->pluck('image');
            array_push($packages,$value);
        }
        return response()->json(['status'=>true,'packagetype'=>$packageType,'packages'=>$packages]);
        

    }
}
