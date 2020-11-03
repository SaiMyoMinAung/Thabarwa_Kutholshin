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
            ],
            [
                'name' => CITY_TWO,
                'state_region_id' => StateRegion::where('name', STATE_REGION_TWO)->first()->id,
            ]
        ];

        City::insert($data);
    }
}
