<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $libraries = [];
        for ($i = 1; $i <= 10; $i++) {
            $libraries[] = [
                'name' => $faker->company . " Library",
                'address' => $faker->address,
                'contact_number' => $faker->phoneNumber,
            ];
        }
        DB::table('libraries')->insert($libraries);
    }
}
