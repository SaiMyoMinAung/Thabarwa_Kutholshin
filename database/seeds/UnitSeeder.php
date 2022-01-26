<?php

use App\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
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
                'package_unit' => 'လီတာ',
                'loose_unit' => 'မီလီ လီတာ',
                'package_symbol' => 'l',
                'loose_symbol' => 'ml',
            ],
            [
                'package_unit' => 'ပိသာ',
                'loose_unit' => 'ကျပ်သား',
                'package_symbol' => 'V',
                'loose_symbol' => 'KT',
            ],
            [
                'package_unit' => 'ပါကင်',
                'loose_unit' => 'အပြည်',
                'package_symbol' => 'P',
                'loose_symbol' => 'LP',
            ],
            // [
            //     'package_unit' => 'Other',
            //     'loose_unit' => 'MiniOther',
            //     'package_symbol' => 'OT',
            //     'loose_symbol' => 'MOT',
            // ],
        ];

        Unit::insert($data);
    }
}
