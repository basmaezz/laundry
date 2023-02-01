<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table   = 'order_details';
    protected $guarded = [];
     protected $fillable=['order_table_id','product_id','category_id','product_service_id','price','quantity'];

    public function orderTables()
    {
        return $this->belongsTo(OrderTable::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function productService()
    {
        return $this->belongsTo(ProductService::class ,'product_service_id','id' );
    }

    public function productCategory()
    {
        return $this->belongsTo(Category::class ,'category_id','id' );
    }
}
