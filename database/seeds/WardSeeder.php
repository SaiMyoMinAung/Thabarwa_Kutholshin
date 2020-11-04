<?php

use App\Ward;
use App\Center;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
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
                'name' => WARD_ONE,
                'center_id' => Center::where('name', CENTER_ONE)->first()->id,
            ],
            [
                'name' => WARD_TWO,
                'center_id' => Center::where('name', CENTER_TWO)->first()->id,
            ]
        ];

        Ward::insert($data);
    }
}
