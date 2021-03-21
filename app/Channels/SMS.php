<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class SMS
{
    const url="https://aakashsms.com/admin/public/sms/v3/send";
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toSMS($notifiable);
        switch (env('smschannel','mock')) {
            case 'aakash':
                $data['auth_token']=env('aakash_token',"");
                $response = Http::post(self::url,$data);
                break;
            
            default:
                $data1=[
                    "number"=>$data['to'],
                    "msg"=>$data['text']
                ];
                $mock=\App\SMSMock::create($data1);
                break;
        }
       
        // try {
            //code...
           
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
        // Send notification to the $notifiable instance...
    }
}