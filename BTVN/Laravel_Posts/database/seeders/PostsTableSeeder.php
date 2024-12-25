<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $posts = [];
        for ($i = 1; $i <= 100; $i++) {
            $posts[] = [
                'title' => $faker->sentence,
                'content' => $faker->paragraph
            ];
        }
        DB::table('posts')->insert($posts);
    }
}
