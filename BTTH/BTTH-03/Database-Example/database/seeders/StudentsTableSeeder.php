<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $students = [];

        for ($i = 1; $i <= 50; $i++) {
            $students[] = [
                'id' => $i,
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'date_of_birth' => $faker->date('Y-m-d', '-5 years'), // Sinh trong vòng 5 năm
                'parent_phone' => $faker->numerify('##########'),
                'class_id' => $faker->numberBetween(1, 10), // Liên kết tới bảng classes
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('students')->insert($students);
    }
}
