<?php

use App\City;
use App\StateRegion;
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
                'name' => CITY_ONE,
                'state_region_id' => StateRegion::where('name', STATE_REGION_ONE)->first()->id,
                'is_available' => 1
            ],
            [
                'name' => CITY_TWO,
                'state_region_id' => StateRegion::where('name', STATE_REGION_TWO)->first()->id,
                'is_available' => 1
            ]
        ];

        City::insert($data);
    }
}
