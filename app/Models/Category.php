<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table   = 'categories';
    protected $guarded = [];
    protected $fillable=['name_en','name_ar','image'];

    public function getImageAttribute($image)
    {
        return  isset($image) ? assetsUpload().'/laundries/'. $image : '';
    }

}
