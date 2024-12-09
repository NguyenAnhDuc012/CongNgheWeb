<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [];
        for ($i = 1; $i <= 10; $i++) {
            $classes[] = [
                'id' => $i,
                'grade_level' => $i % 2 === 0 ? 'Kindergarten' : 'Pre-K',
                'room_number' => 'Room-' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('classes')->insert($classes);
    }
}
