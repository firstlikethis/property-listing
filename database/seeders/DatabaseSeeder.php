<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ZoneSeeder::class,
            DistrictSeeder::class,
            BtsStationSeeder::class,
            TypeSeeder::class,
            FacilitySeeder::class,
        ]);
    }
}