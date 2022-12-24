<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    protected $table = 'product_services';
    protected $guarded = [];


    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

}
