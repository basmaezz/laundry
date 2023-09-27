<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CategoryItem extends Model
{
    protected $guarded = ['id'];
//    protected $connection = 'mysql';
    protected $table = 'category_item';
    protected $fillable=['subcategory_id','category_type','category_type_en','category_type_franco'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function subcategories()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }
    public function scopeItems($query)
    {
         return $query->where('subcategory_id',Auth::user()->subCategory_id);
    }
}
