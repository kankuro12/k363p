<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Message;
use Laravel\Passport\HasApiTokens;
use App\Notifications\CustomResetPasswordNotification;
class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','role_id','active', 'activation_token','provider','provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','activation_token'
    ];

    public function role(){
        return $this->hasOne('App\Role','id','role_id');
    }

    public function checkIfUserRole($need_role){       
        return (strtolower($need_role)==strtolower($this->role->name))?true:false;
    }
    public function hasRole($types){
        if(is_array($types)){
            foreach ($types as $type) {
                if($this->checkIfUserRole($type)){
                    return true;
                }
            }
        }else{
            return $this->checkIfUserRole($types);
        }
        return false;
    }
    public function vendoruser(){
        return $this->hasOne('App\Model\VendorUser\VendorUser','user_id');
    }
    public function vendor(){
        return $this->hasOne('App\Model\Vendor\Vendor','user_id');
    }
    public function sendPasswordResetNotification($token){
        $this->notify(new CustomResetPasswordNotification($token));
    }
    public static function byEmail($email){
        return static::where('email', $email);
    }
    public function hasVerifiedEmail(){
        return $this->active;
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
}
