<?php

use App\Office;
use App\StateRegion;
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
                'state_region_id' => StateRegion::where('name', STATE_REGION_ONE)->first()->id,
                'is_open' => 1,
            ],
            [
                'name' => OFFICE_TWO,
                'uuid' => rand(0, 100000),
                'address' => 'Address Two',
                'state_region_id' => StateRegion::where('name', STATE_REGION_TWO)->first()->id,
                'is_open' => 1,
            ],

        ];

        Office::insert($data);
    }
}
