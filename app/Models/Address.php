<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        "type",
        "app_user_id",
        "city_id",
        "region_name",
        "address",
        "building",
        'lat',
        'lng',
        "default"
    ];
}
