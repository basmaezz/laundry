<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'app_user_id',
        'type',
        'amount',
        'current_amount',
        'direction'
    ];
    protected $casts = [
        'amount' => 'decimal',
    ];
    public function user(){
        return $this->belongsTo(AppUser::class,'app_user_id', 'id');
    }
}
