<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Vendor\Vendor;
use App\Model\Vendor\Review;
use Auth;
class ReviewsController extends Controller
{
    public function index(){
    	$user=Auth::user();
        $vendor=Vendor::where('user_id',$user->id)->firstOrFail();
        $reviews=$vendor->reviews;
    	return view('vendor.reviews.index',compact('reviews'));
    }
    public function show($id){
		$user=Auth::user()->vendor;
	    $review=Review::where(['vendor_id'=>$user->id,'id'=>$id])->firstOrFail();
    	return view('vendor.reviews.show',compact('review'));
    }
}
