<?php

namespace Database\Seeders;

use App\Models\Tags;
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
        $service1 = Services::create([
            'name' => 'Web Development',
            'description' => 'We develop websites for your business',
            'base_price' => 10000000,
            'selling_price' => 15000000,
        ]);

        $service2 = Services::create([
            'name' => 'Mobile Development',
            'description' => 'We develop mobile apps for your business',
            'base_price' => 15000000,
            'selling_price' => 20000000,
        ]);

        $service3 = Services::create([
            'name' => 'UI/UX Design',
            'description' => 'We design user interfaces for your business',
            'base_price' => 5000000,
            'selling_price' => 10000000,
        ]);

        $service4 = Services::create([
            'name' => 'SEO Optimization',
            'description' => 'We optimize your website for search engines',
            'base_price' => 5000000,
            'selling_price' => 10000000,
        ]);

        $service5 = Services::create([
            'name' => 'Digital Marketing',
            'description' => 'We market your business digitally',
            'base_price' => 5000000,
            'selling_price' => 10000000,
        ]);

        $service6 = Services::create([
            'name' => 'Content Writing',
            'description' => 'We write content for your business',
            'base_price' => 5000000,
            'selling_price' => 10000000,
        ]);

        $tag1 = Tags::where('name', 'Web Development')->first();
        $tag2 = Tags::where('name', 'Mobile Development')->first();
        $tag3 = Tags::where('name', 'UI/UX Design')->first();
        $tag4 = Tags::where('name', 'SEO Optimization')->first();
        $tag5 = Tags::where('name', 'Digital Marketing')->first();
        $tag6 = Tags::where('name', 'Content Writing')->first();

        $service1->tags()->attach([$tag1->id, $tag3->id]);
        $service2->tags()->attach([$tag2->id, $tag3->id]);
        $service3->tags()->attach([$tag3->id]);
        $service4->tags()->attach([$tag4->id]);
        $service5->tags()->attach([$tag5->id]);
        $service6->tags()->attach([$tag6->id]);
    }
}
