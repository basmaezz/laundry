<?php

namespace App\Models;

use App\Http\Controllers\Admin\OrderController;
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

    protected $appends = ['spend_time','is_finished'];

    public function order(){
        return $this->belongsTo(OrderTable::class,'order_id','id');
    }

    public function getIsFinishedAttribute(){
        if($this->attributes['status_id'] >= OrderController::Completed){
            return true;
        }
        $next = OrderStatusHistory::where([
            'order_id' => $this->attributes['order_id'],
            'status_id' => $this->attributes['status_id']+1,
        ])->first();
        return $next ?? false;
    }
    public function getSpendTimeAttribute()
    {
        $previous = OrderStatusHistory::where([
            'order_id' => $this->attributes['order_id'],
            'status_id' => $this->attributes['status_id']-1,
        ])->first();
        if($previous) {
            return $previous->created_at->diffInMinutes(Carbon::parse($this->attributes['created_at']));
        }
        return 0;
    }
}
