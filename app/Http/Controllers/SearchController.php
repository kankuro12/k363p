<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Vendor\Vendor;
use App\Model\Vendor\Amenity;
use App\Model\Vendor\RoomAmentiy;
use Illuminate\Support\Facades\Input;
use DB;
use App\Model\Vendor\Booking;
use App\Model\Vendor\Collection;
use App\Model\Vendor\Room;
class SearchController extends Controller
{
  
   public function get_index(Request $request){
    $amenities=Amenity::where('status','active')->get();
    $roomamenities=RoomAmentiy::groupBy('amenity')->get();
    $location=$request->location;
    $vendors =Vendor::where('verified',1);
    $all=$request->all();
    //location filter
    if($request->filled('location')) {
        $vendors=$vendors->WhereHas('location', function($q) use($location) {
            $q->where('name', 'like', '%' . $location . '%');
        });
    }
    if($request->filled('service')) {
        $service=$request->service;
        $vendors=$vendors->WhereHas('category', function($q) use($service) {
            $q->where('name', 'like', '%' . $service. '%');
        });
    }

    //amenities filter     
    if($request->filled('samenities')) {
        $vendors=$vendors->whereHas('amenityvendor', function($query){
            $query->whereIn('amenity_id',request()->samenities);
        });
    }
    //room amenities filter
    if($request->filled('roomamenities')) {
            $vendors=$vendors->whereHas('rooms', function($query){
                $a=$query->whereHas('roomamenities', function($rquery){
                $rquery->whereIn('amenity',request()->roomamenities);
            });                
        });
    }
    if($request->filled('star_rating1')){ 
        $vendors=$vendors->whereHas('reviews', function($q){
        $q->where('status','approved')->havingRaw('AVG(reviews.avg_rating) <= ?', [request()->star_rating1]);                  
        });           
    }
    if($request->filled('star_rating2')){ 
        $vendors=$vendors->whereHas('reviews', function($q){
        $q->where('status','approved')->havingRaw('AVG(reviews.avg_rating) <= ?', [request()->star_rating2]);                  
        });           
    }
    if($request->filled('star_rating3')){ 
        $vendors=$vendors->whereHas('reviews', function($q){
        $q->where('status','approved')->havingRaw('AVG(reviews.avg_rating) <= ?', [request()->star_rating3]);                  
        });           
    }
    if($request->filled('star_rating4')){ 
        $vendors=$vendors->whereHas('reviews', function($q){
        $q->where('status','approved')->havingRaw('AVG(reviews.avg_rating) <= ?', [request()->star_rating4]);                  
        });           
    }
    if($request->filled('star_rating5')){ 
        $vendors=$vendors->whereHas('reviews', function($q){
        $q->where('status','approved')->havingRaw('AVG(reviews.avg_rating) <= ?', [request()->star_rating5]);                  
        });           
    }
    if($request->filled('check_in_time') || $request->filled('check_out_time') || $request->filled('num_rooms')){ 
        $check_in_time=$request->check_in_time;
        $check_out_time=$request->check_out_time;
        $num_rooms=(int)$request->num_rooms;

        $bvenors=DB::table('bookings')
        ->join('rooms', 'bookings.room_id', '=', 'rooms.id') 
        ->select('room_id', DB::raw('count(*) as total'))
        ->selectRaw('(rooms.no_of_rooms- sum(bookings.num_rooms)) AS available_rooms') 
        ->where('booking_status','!=','completed')
        ->whereBetween('check_in_time', [$check_in_time, $check_out_time])
        ->WhereBetween('check_out_time', [$check_in_time, $check_out_time])
        ->groupBy('room_id')->get();
        $rejected_rooms=array();
        foreach ($bvenors as $key => $value) {
            $av=(int)$value->available_rooms;
            if($av==0 || $av<$num_rooms){
                array_push($rejected_rooms,$value->room_id);
                
            }
        }
        
        

        $rooms=Room::where('status','Available')->whereIn('id',$rejected_rooms)->get()->pluck('id');

        $vendors=$vendors->whereHas('rooms', function($q) use ($rooms,$num_rooms){

            $q->where('status','Available')->whereNotIn('id',$rooms)->where('no_of_rooms','>=',$num_rooms);                  
        }); 

        // dd($rooms);

        // dd("h");




        // $not_include=array();

        //     if(!is_null($a[0]['id'])){

        //     $not_include=array();
        //     $c=0;
        //     foreach ($a as $key => $value) {
        //        $a_value=(int)$value->available_rooms;
        //        if($a_value==0 || $a_value<$num_rooms){  
        //        dd($value);             
        //         //array_push($not_include,$value->vendor_id);  
        //         if($value->vendor->rooms->count()<=$c){
        //             array_push($not_include,$value->vendor_id);  
                    
        //         }              
        //        }
        //        $c++;
        //     };
           // dd($c);

            //$vendors->whereNotIn('id',$not_include);
          
            
        
    }
    
    if($request->filled('collection')) {
        $collection=Collection::where('slug',$request->collection)->first();
        $col=$collection->collectionvendors;
        $vids= DB::table('collection_vendors')->where('collection_id',$collection->id)->pluck('vendor_id');
        $vendors=$vendors->whereIn('id',$vids);
    }
    if($request->filled('price_sort')) {
        $vendors=$vendors->orderBy('average_cost',$request->price_sort);
    }
    if($request->filled('start_rating_sort')) {
        $vendors=$vendors->orderBy('star',$request->start_rating_sort);
    }
    $vendors=$vendors->paginate(10)->setPath('');
    $pagination=$vendors->appends(array(
        'location'=>$request->input('location'),
        'samenities'=>$request->input('samenities'),
        'roomamenities'=>$request->input('roomamenities'),
        'num_rooms'=>$request->input('num_rooms'),
        'collection'=>$request->input('collection')

    ));

    



     if ($request->ajax()){
         return view('public.search.ajax',compact('vendors'));
     }else{
         return view('public.search.index',compact('vendors','amenities','roomamenities','all'));
     }
    
   }
}
