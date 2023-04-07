<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'status_id',
        'status',
        'user_id'
    ];

    protected $appends = ['spend_time'];

    public function order(){
        return $this->belongsTo(OrderTable::class,'order_id','id');
    }

    public function getSpendTimeAttribute()
    {
        $next = OrderStatusHistory::where([
            'order_id' => $this->attributes['order_id'],
            'status_id' => $this->attributes['status_id']-1,
        ])->first();
        if($next) {
            return $next->created_at->diffInMinutes(Carbon::parse($this->attributes['created_at']));
        }
        return 0;
    }
}
