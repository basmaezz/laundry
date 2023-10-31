<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carpetLaundryTime extends Model
{
    use HasFactory;

    protected $fillable=['carpet_laundry_id','start_from','end_to','service_type'];

    public function carpetLaundry()
    {
        return $this->belongsTo(carpetLaundry::class);
    }
}
