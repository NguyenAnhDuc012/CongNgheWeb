<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $students = [];
        $classIds = DB::table('classes')->pluck('id');

        for ($i = 1; $i <= 50; $i++) {
            $students[] = [
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'date_of_birth' => $faker->date('Y-m-d', '-5 years'),
                'parent_phone' => $faker->numerify('##########'),
                'class_id' => $faker->randomElement($classIds),
            ];
        }

        DB::table('students')->insert($students);
    }
}
