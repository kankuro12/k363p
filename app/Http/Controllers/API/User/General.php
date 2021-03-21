<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Model\Vendor\Collection;
use App\Model\Vendor\Location;
use App\Model\Vendor\Review;
use App\Model\Vendor\Room;
use App\Model\Vendor\RoomType;
use App\Model\Vendor\Vendor;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class General extends Controller
{
    //
    public function info(){
        $user=Auth::user();
        $user->vendoruser;
        return response()->json(['status'=>true,'user'=>$user]);
    }

   
}
