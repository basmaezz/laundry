<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'transaction_id',
        'status',
        'payload'
    ];

    public function user(){
        return $this->belongsTo(AppUser::class,'user_id','id');
    }

    public function order(){
        return $this->belongsTo(OrderTable::class,'order_id','id');
    }
}
