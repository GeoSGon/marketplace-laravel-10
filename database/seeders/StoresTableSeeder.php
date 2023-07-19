<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Store;
use App\Models\Product;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = Store::all();

        $stores->each(function ($store) {
            $numProducts = rand(1, 5);

            for ($i = 0; $i < $numProducts; $i++) {
                $store->products()->create(Product::factory()->make()->toArray());
            }
        });
    }
}