<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table   = 'favorites';
    protected $guarded = [];

    /**  public function provider . */
    public function provider()
    {
        return $this->belongsTo(User::class,'provider_id');
    }

    /**  public function category . */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
