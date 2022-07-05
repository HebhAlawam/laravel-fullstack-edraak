<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'price', 'size', 'image', 'policy', 'category_id'];

    public function subCategories()
    {
        return $this->belongsToMany(Category::class, 'subcategory_product','product_id', 'subcategory_id');
    }

    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }  

   /* public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
    /* 

    public function subcategory()
    {
        return $this->belongsTo(CategorySubcategory::class);
    }
*/
}
