<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Renter;
use App\Models\Laptop;
use Faker\Factory as Faker;

class LaptopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $renterIds = Renter::all()->pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {
            Laptop::create([
                'brand' => $faker->randomElement(['Dell', 'HP', 'Apple', 'Asus', 'Lenovo']),
                'model' => $faker->word . ' ' . $faker->randomNumber(4),
                'specifications' => $faker->randomElement(['i5, 8GB RAM, 256GB SSD', 'i7, 16GB RAM, 512GB SSD']),
                'rental_status' => $faker->boolean,
                'renter_id' => $faker->randomElement($renterIds),
            ]);
        }
    }
}
