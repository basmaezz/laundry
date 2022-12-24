<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_cart';
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategories()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function productService()
    {
        return $this->belongsTo(ProductService::class, 'product_service_id');
    }
}
