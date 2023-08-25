<?php

namespace App\Models;

use App\Http\Controllers\API\OrderController;
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
        'urgent',
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
        'address_id',
        'commission',
        'total_commission',
        'sum_price'
    ];
    protected $appends = ['is_finnish'];

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
        return $this->hasMany(OrderStatusHistory::class,'order_id','id')->latest();
    }

    public function getLastHistoryAttribute()
    {
        return $this->histories()->orderBy('status_id','desc')->first();
    }

    public function rates(){
        return $this->hasMany(RateLaundry::class,'order_id','id');
    }

    public function payments(){
        return $this->hasMany(Payment::class,'order_id','id');
    }

    public function address(){
        return $this->hasOne(Address::class,'id','address_id')->withDefault();
    }

    public function ScopeOrders($query,$id){
        return $query->where('laundry_id',Auth::user()->subCategory_id);
    }
    public function getIsFinnishAttribute($value): bool
    {
        if(!isset($this->attributes['status_id']) || empty($this->attributes['status_id'])){
            return false;
        }
        return in_array($this->attributes['status_id'], [
            OrderController::Cancel,
            OrderController::Completed,
        ]);
    }

    public function getPercentage()
    {
            $result=($this->subCategoriesTrashed->total_price *$this->subCategoriesTrashed->percentage)/100;

            return $result;
    }

}
