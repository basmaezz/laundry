<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateLaundry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'laundry_id',
        'order_id',
        'rate',
        'review'
    ];

    public function user(){
        return $this->belongsTo(AppUser::class,'user_id', 'id');
    }

    public function order(){
        return $this->belongsTo(OrderTable::class,'order_id', 'id');
    }

    public function laundry(){
        return $this->belongsTo(Subcategory::class,'laundry_id', 'id');
    }
}
