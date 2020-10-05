<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(StateRegionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CitySeeder::class);
    }
}
