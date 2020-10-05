<?php

use App\City;
use App\Country;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Yangon',
                'state_region_id' => Country::first()->id,
            ]
        ];

        City::insert($data);
    }
}
