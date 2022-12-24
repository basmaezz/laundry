<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    protected $guarded = ['id'];
//    protected $connection = 'mysql';
    protected $table = 'category_item';
    protected $fillable=['subcategory_id','category_type'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function subcategories()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }


}
