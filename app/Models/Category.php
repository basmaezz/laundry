<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table   = 'categories';
    protected $guarded = [];

    public function getImageAttribute($image)
    {
        return  isset($image) ? assetsUpload().'/categories/'. $image : '';
    }

}
