<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => "Women"]);
        Category::create(['name' => "Men"]);
        Category::create(['name' => "Kids"]);

        $catIds=[1,2,3];
        foreach ($catIds as $catId) {
            Category::create(['name' => "Jackets", 'parent_id' => $catId ]);
            Category::create(['name' => "Pants", 'parent_id' => $catId]);
            Category::create(['name' => "Sweaters & Shirts", 'parent_id' => $catId]);
            Category::create(['name' => "Shoes", 'parent_id' => $catId]);
            Category::create(['name' => "Bags", 'parent_id' => $catId]);
            Category::create(['name' => "Accessories", 'parent_id' => $catId]);
        }

    }
}
