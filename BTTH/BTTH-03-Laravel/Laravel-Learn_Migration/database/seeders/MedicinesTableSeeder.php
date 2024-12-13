<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MedicinesTableSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();
        $medicines = [];

        for ($i = 1; $i <= 20; $i++) {
            $medicines[] = [
                'name' => $faker->word(),
                'brand' => $faker->company(),
                'dosage' => $faker->randomElement(['10mg', '20mg', '50mg']),
                'form' => $faker->randomElement(['tablet', 'capsule', 'syrup']),
                'price' => $faker->randomFloat(2, 10, 500),
                'stock' => $faker->numberBetween(1, 1000),
            ];
        }
        DB::table('medicines')->insert($medicines);
    }
}
