<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Delegate extends Model
{
    protected $table   = 'delegates';
    protected $guarded = [];

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
}
