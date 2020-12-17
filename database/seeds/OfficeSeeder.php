<?php

use App\Center;
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
                'center_id' => Center::where('name', CENTER_ONE)->first()->id,
                'is_open' => true,
            ],
            [
                'name' => OFFICE_TWO,
                'uuid' => rand(0, 100000),
                'address' => 'Address Two',
                'center_id' => Center::where('name', CENTER_TWO)->first()->id,
                'is_open' => true,
            ],

        ];

        Office::insert($data);
    }
}
