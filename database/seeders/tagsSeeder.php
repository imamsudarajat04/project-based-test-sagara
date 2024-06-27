<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Web Development',
            'Mobile Development',
            'UI/UX Design',
            'SEO Optimization',
            'Digital Marketing',
            'Content Writing',
        ];

        foreach ($tags as $tag) {
            Tags::create([
                'name' => $tag,
                'description' => "Description of $tag",
            ]);
        }
    }
}
