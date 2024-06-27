<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class servicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Services::create([
            'name' => 'Web Development',
            'description' => 'We develop websites for your business',
            'base_price' => 10000000,
            'selling_price' => 15000000,
        ]);

        Services::create([
            'name' => 'Mobile Development',
            'description' => 'We develop mobile apps for your business',
            'base_price' => 15000000,
            'selling_price' => 20000000,
        ]);

        Services::create([
            'name' => 'UI/UX Design',
            'description' => 'We design user interfaces for your business',
            'base_price' => 5000000,
            'selling_price' => 10000000,
        ]);

        Services::create([
            'name' => 'SEO Optimization',
            'description' => 'We optimize your website for search engines',
            'base_price' => 5000000,
            'selling_price' => 10000000,
        ]);

        Services::create([
            'name' => 'Digital Marketing',
            'description' => 'We market your business digitally',
            'base_price' => 5000000,
            'selling_price' => 10000000,
        ]);

        Services::create([
            'name' => 'Content Writing',
            'description' => 'We write content for your business',
            'base_price' => 5000000,
            'selling_price' => 10000000,
        ]);
    }
}
