<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tags::create([
            'name'        => 'Shoes',
            'description' => 'Shoes description',
        ]);

        Tags::create([
            'name'        => 'Shirt',
            'description' => 'Shirt description',
        ]);

        Tags::create([
            'name'        => 'Pants',
            'description' => 'Pants description',
        ]);

        Tags::create([
            'name'        => 'Hat',
            'description' => 'Hat description',
        ]);

        Tags::create([
            'name'        => 'Socks',
            'description' => 'Socks description',
        ]);

        Tags::create([
            'name'        => 'Gloves',
            'description' => 'Gloves description',
        ]);

        Tags::create([
            'name'        => 'Jacket',
            'description' => 'Jacket description',
        ]);
    }
}
