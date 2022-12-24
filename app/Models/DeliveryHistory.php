<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'direction'
    ];

    protected $appends = ['order'];

    public function order(){
        return $this->belongsTo(OrderTable::class,'order_id', 'id');
    }

    public function user(){
        return $this->belongsTo(AppUser::class,'user_id', 'id');
    }
}
