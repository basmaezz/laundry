<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carpetCategory extends Model
{
    use HasFactory;
    protected  $fillable=['carpet_laundry_id','category_en','category_ar','desc_ar','desc_en','price'];

    public function carpetLaundry()
    {
        return $this->belongsTo(carpetLaundry::class,'carpet_laundry_id','id');
    }
}
