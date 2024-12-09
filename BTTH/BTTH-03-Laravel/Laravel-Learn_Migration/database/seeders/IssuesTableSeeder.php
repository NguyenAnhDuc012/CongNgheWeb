<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class IssuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $issues = [];

        for ($i = 1; $i <= 50; $i++) {
            $issues[] = [
                'computer_id' => $faker->numberBetween(1, 10),
                'reported_by' => $faker->name(),
                'reported_date' => $faker->dateTimeThisYear(),
                'description' => $faker->text(),
                'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('issues')->insert($issues);
    }
}
