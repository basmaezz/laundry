<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carpetCategory extends Model
{
    use HasFactory;
    protected  $fillable=['subCategory_id','category_en','category_ar','desc_ar','desc_en','price'];

    public function subCategory()
    {
       return $this->belongsTo(subCategory::class,'subCategory_id');
    }
}
