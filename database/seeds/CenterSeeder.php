<?php

use App\Center;
use App\City;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
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
                'name' => CENTER_ONE,
                'city_id' => City::where('name', CITY_ONE)->first()->id,
                'is_available' => true
            ],
            [
                'name' => CENTER_TWO,
                'city_id' => City::where('name', CITY_TWO)->first()->id,
                'is_available' => true
            ]
        ];

        Center::insert($data);
    }
}
