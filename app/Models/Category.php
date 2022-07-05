<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    // each category has many subCategories
    public function subcategories(){
        return $this->hasMany(self::class, 'parent_id');
    }

    // each subCategory has one category
    public function category(){
        return $this->hasOne(self::class, 'id','parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'subcategory_product','subcategory_id','product_id');
    }

}
