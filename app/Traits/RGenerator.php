<?php
namespace App\Traits;
use App\Model\Vendor\Booking;
trait RGenerator {
    private function generate_code() { 
            do{
                $token = $this->getToken(6);
                $code = 'BK'. $token . substr(strftime("%Y", time()),2);
                $user_code = Booking::where('booking_id', $code)->get();
            }
            while(!$user_code->isEmpty());
            return $code;
        }

        private function getToken($length){    
            $token = "";
            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet.= "0123456789";
            for($i=0;$i<$length;$i++){
                $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
            }
            return $token;
        }
}