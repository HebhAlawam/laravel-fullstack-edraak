<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Models\Product;



class ProductSeeder extends Seeder
{

//1- Jackets 2-Pants 3-Sweaters 4-Shoes 5-Bags 6-Accessories    
    public function run()
    {
        $size = ['S', 'M', 'L', 'XL', 'XXL'];
        for ($i=0; $i <8 ; $i++) { 
       
        $product1 = Product::create([
            'name' => "Jacket",
            'description' => 'black',
            'price' => rand(100,600),
            'size' =>  Arr::random($size),
            'image' => 'seed/15.jpg',
            'policy' => '',
            'category_id' => '2',
        ]);
        $product1->subCategories()->attach([11,13]);

        $product2 = Product::create([
            'name' => "T-shirt",
            'description' => 'blue',
            'price' => rand(100,600),
            'size' =>  Arr::random($size),
            'image' => 'seed/12.jpg',
            'policy' => '',
            'category_id' => '2',
        ]);
        $product2->subCategories()->attach([7,9]);
    }
}
}