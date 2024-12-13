<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SalesTableSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();
        $medicineIds = DB::table('medicines')->pluck('medicine_id');
        $sales = [];

        for ($i = 1; $i <= 100; $i++) {
            $sales[] = [
                'medicine_id' => $faker->randomElement($medicineIds),
                'quantity' => $faker->numberBetween(1, 50),
                'sale_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'customer_phone' => $faker->numerify('##########'),
            ];
        }
        DB::table('sales')->insert($sales);
    }
}
