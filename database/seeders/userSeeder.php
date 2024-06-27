<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id'       => (string) Str::uuid(),
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
