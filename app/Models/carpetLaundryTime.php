<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carpetLaundryTime extends Model
{
    use HasFactory;

    protected $fillable=['subCategory_id','start_from','end_to','service_type'];

    public function subCategory()
    {
        return $this->belongsTo(subCategory::class,'subCategory_id');
    }
}
