<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesTableSeeder extends Seeder
{

    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 100; $i++) {
            DB::table('sales')->insert([
                'sale_id' => $i,
                'medicine_id' => $faker->numberBetween(1, 20),
                'quantity' => $faker->numberBetween(1, 50),
                'sale_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'customer_phone' => $faker->numerify('##########'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
