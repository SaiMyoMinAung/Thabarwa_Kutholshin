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
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'Kayah',
                'code' => '02',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'Kayin',
                'code' => '03',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'Chin',
                'code' => '04',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],

            [
                'name' => 'Sagaing',
                'code' => '05',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'Tanintharyi',
                'code' => '06',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'Bago',
                'code' => '07',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'Magway',
                'code' => '08',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'Mandalay',
                'code' => '09',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'Mon',
                'code' => '10',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],

            [
                'name' => 'Rakhine',
                'code' => '11',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],

            [
                'name' => 'Yangon',
                'code' => '12',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'Shan',
                'code' => '13',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'Ayeyarwady',
                'code' => '14',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],

            [
                'name' => 'Naypyidaw',
                'code' => '15',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
            [
                'name' => 'National',
                'code' => '00',
                'country_id' => Country::where('name', 'Myanmar')->first()->id,
            ],
        ];

        StateRegion::insert($data);
    }
}
