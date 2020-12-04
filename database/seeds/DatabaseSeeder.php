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
        $this->call(CitySeeder::class);
        $this->call(CenterSeeder::class);
        $this->call(WardSeeder::class);
        $this->call(OfficeSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(BoxSeeder::class);
        $this->call(TypeOfAdminSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(YogiSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(KindOfDonationSeeder::class);

        $this->call(VolunteerJobSeeder::class);

        $this->call(VolunteerSeeder::class);
    }
}
