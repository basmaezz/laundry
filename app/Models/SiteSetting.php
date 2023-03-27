<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'sitesetting';
    protected $fillable=['site_name','site_phone','email','whatsapp','distance_range','distance_delegates','site_address','added_tax','delivery_price','register_delegate'];
}
