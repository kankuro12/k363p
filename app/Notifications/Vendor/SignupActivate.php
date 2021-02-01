<?php

namespace App\Notifications\Vendor;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Channels\SMS;
class SignupActivate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail',SMS::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/api/vendor/auth/signup/activate/'.$notifiable->activation_token);
//        return (new MailMessage)
//            ->subject('Confirm your account')
//            ->line('Thanks for signup! Please before you begin, you must confirm your account.')
//            ->action('Confirm Account', url($url))
//            ->line('Thank you for using our application!');

        return (new MailMessage)->subject('Confirm your account!!!')->view(
            'email.vendors.apiactivate',['token'=>$notifiable->activation_token]
        );
    }

    public function toSMS($notifiable){
        $vendor=$notifiable->vendor;
        dd($vendor);
        return ['to'=>$vendor->phone_number,"text"=>"Your Activation Code is ".$notifiable->activation_token];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
