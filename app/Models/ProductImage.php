<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table   = 'product_images';
    protected $guarded = [];

    public function getImageAttribute($image)
    {
        return  isset($image) ? assetsUpload().'/product_images/'. $image : '';
    }

}
