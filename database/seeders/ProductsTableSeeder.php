<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        $products->each(function ($product) {
            $numCategories = rand(1, 5);

            for ($i = 0; $i < $numCategories; $i++) {
            $product->categories()->create(Category::factory()->make()->toArray());
            }
        });
    }

}
