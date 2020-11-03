<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockSmsController extends Controller
{
    public function mock(Request $request){
        $data=$request->all();
        $mock=\App\SMSMock::create($data);
        return response()->json($mock);
    }

    public function show(){
        foreach (\App\SMSMock::all() as $key => $value) {
            echo "<div>".$value->number."||".$value->msg."</div>";
        }
    }
}
