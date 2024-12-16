<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HardwareDevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $centerIds = DB::table('it_centers')->pluck('id');
        $hardwares = [];

        for ($i = 0; $i < 50; $i++) {
            $hardwares[] = [
                'device_name' => $faker->word . ' ' . $faker->randomNumber(3),
                'type' => $faker->randomElement(['Mouse', 'Keyboard', 'Headset']),
                'status' => $faker->boolean(80),
                'center_id' => $faker->randomElement($centerIds),
            ];
        }
        DB::table('hardware_devices')->insert($hardwares);
    }
}
