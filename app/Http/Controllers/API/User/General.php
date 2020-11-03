<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class General extends Controller
{
    //
    public function info(){
        $user=Auth::user();
        $user->vendoruser;
        return response()->json($user);
    }
}
