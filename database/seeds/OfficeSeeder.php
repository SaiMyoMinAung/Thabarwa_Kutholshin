<?php

use App\City;
use App\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
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
                'name' => OFFICE_ONE,
                'uuid' => rand(0, 100000),
                'address' => 'Address One',
                'city_id' => City::where('name', CITY_ONE)->first()->id,
                'is_open' => true,
            ],
            [
                'name' => OFFICE_TWO,
                'uuid' => rand(0, 100000),
                'address' => 'Address Two',
                'city_id' => City::where('name', CITY_TWO)->first()->id,
                'is_open' => true,
            ],

        ];

        Office::insert($data);
    }
}
