<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Nationality extends Model
{
    use HasFactory;

    protected $fillable=['name_en','name_ar'];

    public function delegate():BelongsTo
    {
        return $this->hasMany(Delegate::class);
    }
}
