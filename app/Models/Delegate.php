<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegate extends Model
{
    protected $table   = 'delegates';
    use SoftDeletes;
    protected $guarded = [];
    protected $fillable=
        ['user_id',
        'id_number',
        'id_image',
        'app_user_id',
        'iban_number',
        'bank_id',
        'nid_image',
        'nationality_id',
        'car_manufacture_year_id',
        'car_plate_letter',
        'car_plate_number',
        'car_picture_front',
        'car_picture_behind',
        'car_registration',
        'license_end_date',
        'request_employment',
        'driving_license',
        'car_type',
        'medic_check',
        'registered',
        'user_type',
            'identity_expiration_date'
        ];

//    public static function boot() {
//        parent::boot();
//
//        static::deleting(function($delegate) { // before delete() method call this
//            Delegate::with('appUserTrashed')->delete();
//            // do the rest of the cleanup...
//        });
//    }

    protected function avatar():Attribute
    {
        return Attribute::make(
          get:fn ($value)=>asset('assets/uploads/delegates/avatar'.$value)
        );
    }

    protected function medicCheck(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('assets/uploads/medic_check/'.$value)
        );
    }
    protected function idImage(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('assets/uploads/nid_image/'.$value)
        );
    }
    protected function carPictureFront(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('assets/uploads/car_front/'.$value)
        );
    }
    protected function carPictureBehind(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('assets/uploads/car_back/'.$value)
        );
    }
    protected function carRegistration(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('assets/uploads/car_registration/'.$value)
        );
    }
    protected function drivingLicense(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('assets/uploads/driving_license/'.$value)
        );
    }

    public  function appUserTrashed(){
        return $this->belongsTo(AppUser::class,'app_user_id')->withTrashed();
    }


    public function CarType(){
        return $this->belongsTo(CarType::class,'car_type');
    }
    public function year(){
        return $this->belongsTo(Year::class,'car_manufacture_year_id');
    }
    public function bank(){
        return $this->belongsTo(Bank::class,'bank_id');
    }
    public function nationality(){
        return $this->belongsTo(Nationality::class,'nationality_id');
    }



}
