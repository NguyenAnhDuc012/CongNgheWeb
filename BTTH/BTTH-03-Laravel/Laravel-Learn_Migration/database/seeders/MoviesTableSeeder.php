<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $cinemasIds = DB::table('cinemas')->pluck('id');
        $movies = [];
        for ($i = 0; $i < 50; $i++) {
            $movies[] = [
                'title' => $faker->sentence(3),
                'director' => $faker->name,
                'release_date' => $faker->date(),
                'duration' => $faker->numberBetween(90, 180),
                'cinema_id' => $faker->randomElement($cinemasIds),
            ];
        }
        DB::table('movies')->insert($movies);
    }
}
