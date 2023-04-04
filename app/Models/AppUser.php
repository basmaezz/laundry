<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AppUser extends Authenticatable implements JWTSubject
{

    use SoftDeletes;
    protected $guarded = ['id'];
    protected $connection = 'mysql';
    protected $table = 'app_users';
    protected $dates = ['deleted_at'];
    protected $withCount = ['orders'];
    protected $with = ['default_address'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function cities() {
        return $this->belongsTo(City::class,'city_id');
    }

    public function rates(){
        return $this->hasMany(RateLaundry::class,'user_id','id');
    }

    public function orders(){
        return $this->hasMany(OrderTable::class,'user_id','id');
    }

    public function addresses(){
        return $this->hasMany(Address::class,'app_user_id','id');
    }

    public function default_address(){
        return $this->hasOne(Address::class,'app_user_id','id')->where(['default'=>true]);
    }

    public function getWalletAttribute($value)
    {
        return number_format(floor($value), 2);
    }

    public function getUserLocation($user,$customer){
        return getDistanceFirst1($customer, $user->lat, $user->lng);
    }

    public function setPhoneAttribute($value){
        $this->attributes['phone'] = '966'.$value;
    }


}
