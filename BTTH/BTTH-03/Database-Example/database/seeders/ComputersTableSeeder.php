<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ComputersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $computers = [];

        for ($i = 1; $i <= 10; $i++) {
            $computers[] = [
                'computer_name' => 'Lab-PC' . $i,
                'model' => $faker->company . ' Model ' . $i,
                'operating_system' => $faker->randomElement(['Windows 10', 'Linux', 'macOS']),
                'processor' => $faker->randomElement(['Intel Core i5', 'Intel Core i7', 'AMD Ryzen 5']),
                'memory' => $faker->numberBetween(4, 16),
                'available' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('computers')->insert($computers);
    }
}
