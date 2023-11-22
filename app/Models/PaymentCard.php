<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_brand',
        'last4digits',
        'holder',
        'expiry_month',
        'expiry_year',
        'registration_id'
    ];
}
