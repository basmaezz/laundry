<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class carService extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected  $fillable=['subCategory_id','name_en','name_ar','desc_ar','desc_en','price','image'];
    protected $dates = ['deleted_at'];

    public function subCategory()
    {
        return $this->belongsTo(subCategory::class,'subCategory_id');
    }
}
