<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;
    protected $table   = 'products';
    protected $guarded = [];
    protected $fillable=['user_id','category_item_id','subcategory_id','urgentWash','name_en','name_ar','desc_en','desc_ar','image'];
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


    public function subcategoryTrashed()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id')->withTrashed();;
    }

    public function categoryItem()
    {
        return $this->belongsTo(CategoryItem::class, 'category_item_id');
    }

    public function productTrashed()
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();;
    }

    public function user()
    {
       return $this->belongsTo(User::class ,'user_id');
    }

    public function getImageAttribute($image)
    {
        if(isset($image)){
            if( Str::contains($image,assetsUpload())){
               return $image;
            }else{
                return   assetsUpload().'/laundries/products/'. $image ;
            }
        }
//        return   assetsUpload().'/laundries/products/'. $image ;

    }
}
