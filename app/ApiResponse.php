<?php

namespace App;

class ApiResponse{

    public static function success(  $data=[]){
        $data['success']= true;
        return response()->json($data);
    }

    public static function error($data=[])
    {
        $data['success'] = false;
        return response()->json($data);
    }

}
