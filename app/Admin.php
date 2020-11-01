<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//Notification for Admin
use App\Notifications\AdminResetPasswordNotification;
class Admin extends Authenticatable
{
	use Notifiable;	
	
    protected $fillable = [
		'name',
		'email',
		'password',
		'active',
		'admin',
		'avatar',
		'about',
		'designation'
	];

	protected $hidden = [
        'password',
    ];

    public function sendPasswordResetNotification($token)
      {
          $this->notify(new AdminResetPasswordNotification($token));
      }
}
