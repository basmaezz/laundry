<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table   = 'products';
    protected $guarded = [];
    protected $fillable=['user_id','category_item_id','subcategory_id','name_en','name_ar','desc_en','desc_ar','image'];

    use SoftDeletes;

    protected $dates = ['deleted_at'];
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

    public function categoryItem()
    {
        return $this->belongsTo(CategoryItem::class, 'category_item_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
       return $this->belongsTo(User::class ,'user_id');
    }

    public function getImageAttribute($image)
    {
        return  isset($image) ? assetsUpload().'/laundries/products/'. $image : '';
    }
}
