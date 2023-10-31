<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carpetLaundry extends Model
{
    use HasFactory;

    protected $fillable=['area_name','approximate_duration','lat','lng','range','delivery_price'];

    public function carpetCategory()
    {
        return $this->hasMany(carpetCategory::class,'carpet_laundry_id','id');
    }



}
