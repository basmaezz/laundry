<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table   = 'banners';
    protected $guarded = [];


    public function getImageAttribute($image)
    {
        return  isset($image) ? assetsUpload().'/banners/'. $image : '';
    }
}
