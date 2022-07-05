<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use App\Models\Category;


class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::get();
        foreach ($categories as $category) {
            SubCategory::create(['name' => "Jackets", 'category_id' => $category->id ]);
            SubCategory::create(['name' => "Pants", 'category_id' => $category->id]);
            SubCategory::create(['name' => "Sweaters & Shirts", 'category_id' => $category->id]);
            SubCategory::create(['name' => "Shoes", 'category_id' => $category->id]);
            SubCategory::create(['name' => "Bags", 'category_id' => $category->id]);
            SubCategory::create(['name' => "Accessories", 'category_id' => $category->id]);
        }
        

        

    }
}
