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
    protected $fillable=[
        'uuid',
        'name',
        'password',
        'email',
        'mobile',
        'city_id',
        'region_name',
        'avatar',
        'user_type',
        'status',
        'fcm_token',
        'wallet',
        'point',
        'image',
        'gender',
        'lat',
        'lng',
        'available'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function citiesTrashed() {
        return $this->belongsTo(City::class,'city_id')->withTrashed();
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
        return $this->hasOne(Address::class,'app_user_id','id')->where(['default'=>true])->withDefault();
    }

    public function getWalletAttribute($value)
    {
        return number_format(floor($value), 2);
    }

    public function getUserLocation($user,$customer){
        return getDistanceFirst1($customer, $user->lat, $user->lng);
    }

//    public function setMobileAttribute($value){
//        return  $this->attributes['mobile'] = '966'.$value;
//    }
//    public function getMobileAttribute($value)
//    {
//        return $this->attributes['mobile'] =substr($value, -9);
//    }

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function delegates()
    {
       return $this->hasMany(Delegate::class,'app_user_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeAvailable($query)
    {
        return $query->where('available', 1);
    }

    public function scopeType($query, $type)
    {
        return $query->where('user_type', $type);
    }

    public function scopeDelivery($query)
    {
        return $query->type('delivery');
    }

}
