<?php

namespace App\Models;

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

    public function order(){
        return $this->belongsTo(OrderTable::class,'order_id','id');
    }
}
