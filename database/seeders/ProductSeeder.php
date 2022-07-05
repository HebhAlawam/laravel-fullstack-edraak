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

       
    $product1 = Product::create([
        'name' => "BANDIT FULL ZIP",
        'description' => 'Black - An excellent first layer for its combo of wicking side panels and warm sweater knit bonded to fleece everywhere else, the full zip Bandit Fleece Jacket is made for cold-weather sports, but is stylish enough for just sauntering around town.',
        'price' => rand(100,600),
        'size' =>  Arr::random($size),
        'image' => 'seed/15.jpg',
        'policy' => '',
        'category_id' => '2',
    ]);
    $product1->subCategories()->attach([10]);

    $product2 = Product::create([
        'name' => "SWEATSHIRT",
        'description' => 'Red - Contrast is a key feature on our Unisex Fitted Zip Hoodie with its white zipper and drawcord. We use premium ring-spun cotton to achieve a smooth and stable fabric surface for printing. ',
        'price' => rand(100,600),
        'size' =>  Arr::random($size),
        'image' => 'seed/13.jpg',
        'policy' => '',
        'category_id' => '2',
    ]);
    $product2->subCategories()->attach([12]);

    $product3 = Product::create([
        'name' => "Shoes",
        'description' => 'Brown - The shoe itself has received the American Podiatric Medical Association (APMA) Seal of Acceptance, which podiatrists recognize to be a superior promotion for good foot health.',
        'price' => rand(100,600),
        'size' =>  Arr::random($size),
        'image' => 'seed/menShose.jpg',
        'policy' => '',
        'category_id' => '2',
    ]);
    $product3->subCategories()->attach([13]);

    $product4 = Product::create([
        'name' => "Wolf bag",
        'description' => 'Gray - THE MINI CHLOE TOP HANDLE BAG.',
        'price' => rand(100,600),
        'size' =>  Arr::random($size),
        'image' => 'seed/womenBag.jpg',
        'policy' => '',
        'category_id' => '1',
    ]);
    $product4->subCategories()->attach([8]);

    $product5 = Product::create([
        'name' => "New Markdown",
        'description' => 'White - Kids Graphic Tee (Toddler, Little Boy & Big Boy)',
        'price' => rand(100,600),
        'size' =>  Arr::random($size),
        'image' => 'seed/16.jpg',
        'policy' => '',
        'category_id' => '3',
    ]);
    $product5->subCategories()->attach([18]);

    $product7 = Product::create([
        'name' => "Sustainable Style",
        'description' => 'Blue - Kids Cotton Sweatshirt',
        'price' => rand(100,600),
        'size' =>  Arr::random($size),
        'image' => 'seed/17.jpg',
        'policy' => '',
        'category_id' => '3',
    ]);
    $product7->subCategories()->attach([18]);
    
}
}