<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            MedicinesTableSeeder::class,
            SalesTableSeeder::class,
            ClassesTableSeeder::class,
            StudentsTableSeeder::class,
            ComputersTableSeeder::class,
            IssuesTableSeeder::class,
            LibrarySeeder::class,
            BookSeeder::class,
            RenterSeeder::class,
            LaptopSeeder::class,
            ItCentersSeeder::class,
            HardwareDevicesSeeder::class,
            CinemasTableSeeder::class,
            MoviesTableSeeder::class,
        ]);
    }
}
