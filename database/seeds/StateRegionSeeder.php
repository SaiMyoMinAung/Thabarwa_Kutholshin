<?php

use App\Country;
use App\StateRegion;
use Illuminate\Database\Seeder;

class StateRegionSeeder extends Seeder
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
                'name' => 'Kachin',
                'code' => '01',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],
            [
                'name' => 'Kayah',
                'code' => '02',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],
            [
                'name' => 'Kayin',
                'code' => '03',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],
            [
                'name' => 'Chin',
                'code' => '04',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],

            [
                'name' => 'Sagaing',
                'code' => '05',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],
            [
                'name' => 'Tanintharyi',
                'code' => '06',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],
            [
                'name' => 'Bago',
                'code' => '07',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],
            [
                'name' => 'Magway',
                'code' => '08',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],
            [
                'name' => STATE_REGION_TWO,
                'code' => '09',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 1
            ],
            [
                'name' => 'Mon',
                'code' => '10',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],

            [
                'name' => 'Rakhine',
                'code' => '11',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],

            [
                'name' => STATE_REGION_ONE,
                'code' => '12',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 1
            ],
            [
                'name' => 'Shan',
                'code' => '13',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],
            [
                'name' => 'Ayeyarwady',
                'code' => '14',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],

            [
                'name' => 'Naypyidaw',
                'code' => '15',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],
            [
                'name' => 'National',
                'code' => '00',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
                'is_available' => 0
            ],
        ];

        StateRegion::insert($data);
    }
}
