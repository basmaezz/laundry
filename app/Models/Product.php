<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table   = 'products';
    protected $guarded = [];

    public function productService()
    {
       return $this->hasMany(ProductService::class ,'product_id' );
    }
    public function productImages()
    {
       return $this->hasMany(ProductImage::class ,'product_id' );
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
       return $this->belongsTo('App\User' ,'user_id');
    }

    public function getImageAttribute($image)
    {
        return  isset($image) ? assetsUpload().'/product_images/'. $image : '';
    }
}
