<?php

namespace App\Http\Controllers;

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
    public function home(){
    	$featured_vendors=Vendor::where(['featured'=>'active','verified'=>1])->take(8)->inRandomOrder()->latest()->get();
      $trs=Room::all();  
      $popular_vendors= Vendor::leftJoin('reviews', 'reviews.vendor_id', '=', 'vendors.id')
      ->select(array('vendors.*',
        DB::raw('SUM(avg_rating) as ratings_average')
        ))
      ->where('reviews.status','=','approved')
      ->where('reviews.avg_rating','>',4)
      ->groupBy('id')
      ->orderBy('ratings_average', 'DESC')
      ->get();  
      $collections=Collection::where('status',1)->get();

    	return view('public.home',compact('featured_vendors','trs','popular_vendors','collections'));
    }

    public function home1(){
    	$featured_vendors=Vendor::all();
      $trs=Room::all();  
      $roomtypes=RoomType::all();
      $popular_vendors= Vendor::leftJoin('reviews', 'reviews.vendor_id', '=', 'vendors.id')
      ->select(array('vendors.*',
        DB::raw('SUM(avg_rating) as ratings_average')
        ))
      ->where('reviews.status','=','approved')
      ->where('reviews.avg_rating','>',4)
      ->groupBy('id')
      ->orderBy('ratings_average', 'DESC')
      ->get();  
      $collections=Collection::where('status',1)->get();


    	return view('public.home1',compact('featured_vendors','trs','popular_vendors','collections','roomtypes'));
    }

    public function search(Request $request){
        $locations=Location::where('name','like','%'.$request->name.'%')->whereNotNull('name')->distinct('name')->get();
        $cities=city::where('name','like','%'.$request->name.'%')->whereNotNull('name')->distinct('name')->get();
        
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
      $reviews = $vendor->reviews()->where('status','approved')->latest()->paginate(3);
    	return view('public.single_vendor_1',compact('vendor','nearbies','reviews'));
    }
    public function get_review(Request $request,$slug){

      $vendor=Vendor::where('slug',$slug)->firstOrFail();
      $reviews = $vendor->reviews()->where('status','approved')->latest();

      
      if($request->has('page')) {
          $reviews=$reviews->paginate(3);
      }
      $returnHTML = view('public.room.review', compact('reviews'))->render();
      
      return response()->json(['html'=>$returnHTML,'page'=>$reviews->currentPage(),'hasMorePages'=>$reviews->hasMorePages()]);

    }
    public function about_us(){
      return view('public.about_us');
    }
    public function term_and_condition (){
      return view('public.term_and_condition');
    }
    public function faqs(){
      return view('public.faqs');
    }
    public function privacy_policy(){
      return view('public.privacy_policy');
    }
    public function contact_us(){
      return view('public.contact_us');
    }
    public function payment_option(){
      return view('public.payment_option');
    }
    public function how_to_book(){
      return view('public.how_to_book');
    }
    public function list_business(){
      return view('public.list_business');
    }
    public function contactus(Request $r){
        if($r->ajax()){
            $this->validate($r,['name'=>'required','email'=>'required','phone'=>'required','subject'=>'required','message']);

            return response()->json(['success'=>Enquiry::insert($r->except('_token'))]);
        }
    }
    public function get_state_from_country($id){
        $states=State::where('country_id','=',$id)->get();
        return response()->json($states);
    }
    public function get_cities_from_state($id){
        $cities=City::where('state_id','=',$id)->get();
        return response()->json($cities);
    }
    public function get_room($vslug,$rslug){
        $vendor=Vendor::where('slug',$vslug)->firstOrFail();
        $room=Room::where('slug',$rslug)->firstOrFail();
        return view('public.room.index',compact('room','vendor'));
    }
    public function get_tourism_area($slug){
      $tourismArea=TourismArea::where('slug',$slug)->firstOrFail();
      $othertourismAreas=TourismArea::where('id','!=',$tourismArea->id)->where(['status'=>'active'])->take(4)->get();
      return view('public.getTourismArea',compact('tourismArea','othertourismAreas'));
    }
    
}
