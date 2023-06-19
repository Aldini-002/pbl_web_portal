<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin Utama',
            'email' => 'a@gmail.com',
            'password' => bcrypt('123123'),
            'image' => 'me.png',
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Instrkutur',
            'email' => 'b@gmail.com',
            'password' => bcrypt('123123'),
            'image' => 'me.png',
            'role' => 'instruktur',
        ]);

        \App\Models\User::factory(100)->create();
        Category::factory(10)->create();
        Course::factory(20)->create();
    }
}
