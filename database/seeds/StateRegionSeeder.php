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
            ],
            [
                'name' => 'Kayah',
                'code' => '02',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
            [
                'name' => 'Kayin',
                'code' => '03',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
            [
                'name' => 'Chin',
                'code' => '04',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],

            [
                'name' => 'Sagaing',
                'code' => '05',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
            [
                'name' => 'Tanintharyi',
                'code' => '06',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
            [
                'name' => 'Bago',
                'code' => '07',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
            [
                'name' => 'Magway',
                'code' => '08',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
            [
                'name' => STATE_REGION_ONE,
                'code' => '09',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
            [
                'name' => 'Mon',
                'code' => '10',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],

            [
                'name' => 'Rakhine',
                'code' => '11',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],

            [
                'name' => STATE_REGION_TWO,
                'code' => '12',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
            [
                'name' => 'Shan',
                'code' => '13',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
            [
                'name' => 'Ayeyarwady',
                'code' => '14',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],

            [
                'name' => 'Naypyidaw',
                'code' => '15',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
            [
                'name' => 'National',
                'code' => '00',
                'country_id' => Country::where('name', COUNTRY_ONE)->first()->id,
            ],
        ];

        StateRegion::insert($data);
    }
}
