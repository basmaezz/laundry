<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderTable extends Model
{


    protected static function booted()
    {
        static::created(function ($order) {
            OrderStatusHistory::create([
                'order_id' => $order->id,
                'status_id' => $order->status_id,
                'status' => $order->status,
                'user_id'  => $order->user_id
            ]);
        });
        static::updating(function ($order) {
            if ($order->isDirty('status_id')) {
                OrderStatusHistory::create([
                    'order_id' => $order->id,
                    'status_id' => $order->status_id,
                    'status' => $order->status,
                    'user_id' => $order->user_id
                ]);
            }
        });
    }
    protected $table   = 'order_tables';
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'category_id',
        'laundry_id',
        'delivery_id',
        'total_price',
        'count_products',
        'status',
        'status_id',
        'discount_value',
        'note',
        'delivery_fees',
        'address_id',
        'payment_method',
        'coupon',
        'discount',
        'delivery_type',
        'audio_note',
        'vat',
        'address_id'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class ,'order_table_id' ,'id');
    }

    public function userTrashed()
    {
        return $this->belongsTo(AppUser::class ,'user_id','id' )->withTrashed();
    }
    public function delegateTrashed()
    {
        return $this->belongsTo(Delegate::class ,'delivery_id','app_user_id');
    }

    public function productServiceTrashed()
    {
        return $this->belongsTo(ProductService::class, 'product_service_id')->withTrashed();;
    }

    public function subCategoriesTrashed()
    {
        return $this->belongsTo(Subcategory::class, 'laundry_id')->withTrashed();;
    }

    public function histories()
    {
        return $this->hasMany(OrderStatusHistory::class,'order_id','id');
    }

    public function getLastHistoryAttribute()
    {
        return $this->histories()->orderBy('status_id','desc')->first();
    }

    public function rates(){
        return $this->hasMany(RateLaundry::class,'order_id','id');
    }

    public function address(){
        return $this->hasOne(Address::class,'id','address_id')->withDefault();
    }

    public function ScopeOrders($query,$id){
        return $query->where('laundry_id',Auth::user()->subCategory_id);
    }
    /*public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M');
    }*/
}
