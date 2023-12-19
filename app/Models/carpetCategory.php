<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\SoftDeletes;

class carpetCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected  $fillable=['subCategory_id','category_en','category_ar','desc_ar','desc_en','price','laundry_profit'];
    protected $dates = ['deleted_at'];

    public function subCategory()
    {
       return $this->belongsTo(subCategory::class,'subCategory_id');
    }
}
