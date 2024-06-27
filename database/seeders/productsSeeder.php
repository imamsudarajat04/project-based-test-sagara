<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;
use App\Models\Tags;

class productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create new Product
        $product = Products::create([
            'name' => 'Product 1',
            'description' => 'Description of product 1',
            'purchasing_price' => 1000000,
            'selling_price' => 1500000,
            'quantity' => 10,
        ]);

        // Attach tags to product
        $tagIds = [
            Tags::where('name', 'Web Development')->first()->id,
            Tags::where('name', 'Mobile Development')->first()->id,
        ];

        // sync tags to product
        $product->tags()->attach([$tagIds[0], $tagIds[1]]);
    }
}
