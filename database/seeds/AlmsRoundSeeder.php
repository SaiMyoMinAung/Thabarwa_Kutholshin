<?php

use App\Center;
use App\AlmsRound;
use Illuminate\Database\Seeder;

class AlmsRoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $center = Center::where('name', CENTER_ONE)->first();

        $data = [
            [
                'name' => ALMS_ROUND_ONE,
                'center_id' => $center->id
            ],
            [
                'name' => ALMS_ROUND_TWO,
                'center_id' => $center->id
            ]
        ];

        AlmsRound::insert($data);
    }
}
