<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    protected $table   = 'order_details';
    protected $guarded = [];
    protected $fillable=['order_table_id','category_id', 'product_id', 'category_item_id', 'product_service_id','carpet_category_id','price', 'quantity', 'total_price', 'commission', 'total_commission', 'full_price','laundry_profit','app_profit'];
    use SoftDeletes;

    public function orderTables()
    {
        return $this->belongsTo(OrderTable::class);
    }

    public function productTrashed(){
        return $this->belongsTo(Product::class,'product_id')->withTrashed();
    }

    public function productService()
    {
        return $this->belongsTo(ProductService::class ,'product_service_id','id' );
    }

    public function categoryItem()
    {
        return $this->belongsTo(CategoryItem::class ,'category_item_id','id' );
    }

    public function carpetCategoryTrashed()
    {
        return $this->belongsTo(carpetCategory::class,'carpet_category_id','id')->withTrashed();
    }
    public function carService()
    {
        return $this->belongsTo(carService::class ,'car_service_id','id' );
    }
}
