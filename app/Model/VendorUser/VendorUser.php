<?php

namespace App\Model\VendorUser;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\User;
use App\Model\Vendor\Review;
use App\Model\Vendor\City;
use App\Model\Vendor\Booking;
class VendorUser extends Model
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'fname'
            ]
        ];
    }
    protected $fillable=[
        'fname',
        'lname',
        'slug',
        'mobile_number',
        'profile_img',
        'cover_img',
        'secondary_email',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'tripadvisor_url',
        'user_id',
        'location',
        'lat',
        'lng'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function bookings(){
        return $this->hasMany(Booking::class,'user_id','id');
    }
    public function favourites(){
        return $this->hasMany(Favourite::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
}
