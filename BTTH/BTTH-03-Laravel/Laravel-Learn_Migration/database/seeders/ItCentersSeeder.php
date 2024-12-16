<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ItCentersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $Itcenters = [];
        for ($i = 0; $i < 10; $i++) {
            $Itcenters[] = [
                'name' => $faker->company,
                'location' => $faker->address,
                'contact_email' => $faker->unique()->safeEmail,
            ];
        }
        DB::table('it_centers')->insert($Itcenters);
    }
}
