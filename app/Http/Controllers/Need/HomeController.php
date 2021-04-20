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
        return view('themes.needtech.home.index',compact('roomtypes','featured_vendors','trs','collections'));
    }

    public function locSearch(Request $request){
        $cities=City::where('name','like',$request->keyword.'%')->select('name')->get();
        $locations=Location::where('name','like',$request->keyword.'%')->distinct()->select('name')->get();
        $data=$cities->merge($locations);
        return response()->json(compact('data'));
    }

    public function mobileSearch(Request $request){
        $cities=City::where('name','like',$request->keyword.'%')->select('name')->take(10)->get();
        $locations=Location::where('name','like',$request->keyword.'%')->distinct()->select('name')->take(10)->get();
        $vendors=Vendor::where('name','like',$request->keyword.'%')->take(10)->get();
        return view('themes.needtech.search.mobile',compact('cities','locations','vendors'));
    }

    public function search(Request $request){
        // dd($request->all());
        return view('themes.needtech.search.empty',['all'=>$request->all()]);
    }

    public function ajaxSearch(Request $request){
        // dd($request);
        $location=$request->location;

        // dd($service);
        $vendors =Vendor::where('verified',1);
        $all=$request->all();

        $vendors=$vendors->Where('name', 'like', '%' . $location . '%');
        // dd($vendors->get());
        if($request->filled('location')) {
            $vendors=$vendors->orWhereHas('location', function($q) use($location) {
                $cityids=City::where('name','like','%' . $location . '%')->pluck('id');
                $q->where('name', 'like', '%' . $location . '%')->orWhereIn('city_id',$cityids);
            });
            $vendors=$vendors->orWhereHas('rooms',function($q) use($location){
                $q->where('name', 'like', '%' . $location . '%');
            });
        }


        $v=$vendors->get();


        // dd($v);
        $all=[];
        $hasservice=$request->filled('service');
        foreach($v as $vendor){
            $items=Room::where('vendor_id',$vendor->id);
            if($hasservice){
                $service=$request->service;
                if(count($service)>0){
                    $items=$items->whereIn('roomtype_id',$service);
                }

            }
            if($request->filled('pricerange')){
                $items=$items->whereBetween('(price ', $request->pricerange);
            }




            if($items->count()>0){
                $vendor->services=$items->get();
                array_push($all,$vendor);
            }
        }

        $pricemin=0;
        $pricemax=Room::max('price');
        if($pricemin==0 && $pricemax==0){
            $min=0;
            $max=0;
        }else{

            $min=$pricemin;
            $max=$pricemax;
        }

        // dd($min,$max,$pricemin,$pricemax);
        if($request->filled('valmin')){
            $valmin=$request->valmin;
        }else{
            $valmin=$min;
        }
        if($request->filled('valmax')){
            $valmax=$request->valmax;
        }else{
            $valmax=$max;
        }
        $services=[];
        if($hasservice){

            $services=$request->service;
        }
        // dd(compact('hasservice','valmin','valmax','min','max','all'));
        // dd($v,$all);

        return view('themes.needtech.search.location_search',compact('services','hasservice','valmin','valmax','min','max','all'));
    }

    public function single_vendor($slug){
        $vendor=Vendor::where('slug',$slug)->firstOrFail();
    	$lat = $vendor->location->lat;
    	$lng = $vendor->location->lng;
    	$distance = 20;
        $nearbies=Location::selectRaw('*, ( 6367 * acos( cos( radians( ? ) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( lat ) ) ) ) AS distance', [$lat, $lng, $lat])
        ->having('distance', '<', $distance)
        ->orderBy('distance')
        ->where('vendor_id','<>',$vendor->id)
        ->get();
        $reviews = $vendor->reviews;
        $services=Room::where('vendor_id',$vendor->id)->get()->groupBy('roomtype_id');

        // dd(compact('reviews'));
    	return view('themes.needtech.vendor.index',compact('services','vendor','nearbies','reviews'));

    }

    public function single_service($v_slug,$r_slug){
        $vendor=Vendor::where('slug',$v_slug)->firstOrFail();
        $room=Room::where('slug',$r_slug)->firstOrFail();
    	return view('themes.needtech.vendor.service.index',compact('vendor','room'));

    }

    public function collection($slug){
        $collection=Collection::where('slug',$slug)->first();
    	return view('themes.needtech.collection.index',compact('collection'));

    }

    public function servicetype($slug){
        $roomtype=RoomType::where('slug',$slug)->first();
    	return view('themes.needtech.servicetype.index',compact('roomtype'));

    }

    public function NearMe(Request $request){
        if($request->getMethod()=="POST"){
            $lat = $request->lat;
            $lng = $request->lng;
            $distance = 20;
            $nearbies=Location::selectRaw('*, ( 6367 * acos( cos( radians( ? ) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( lat ) ) ) ) AS distance', [$lat, $lng, $lat])
            ->having('distance', '<', $distance)
            ->orderBy('distance')->with('vendor')
            ->get();
            return response()->json($nearbies);
        }else{
            return view('themes.needtech.nearme.index');
        }
    }
}
