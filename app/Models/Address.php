<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        "description",
        "app_user_id",
        "city_id",
        "region_name",
        "address",
        "building",
        'lat',
        'lng',
        'image',
        "default"
    ];

    protected $appends = ['image_url'];

    public function imageUrl(){
        return asset('assets/uploads/users_image/'.$this->attributes['image']);
    }
}
