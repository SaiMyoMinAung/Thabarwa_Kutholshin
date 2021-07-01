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
                'package_unit' => 'Liter',
                'loose_unit' => 'Milliliter',
                'package_symbol' => 'l',
                'loose_symbol' => 'ml',
            ],
            [
                'package_unit' => 'Viss',
                'loose_unit' => 'Kyat Tar',
                'package_symbol' => 'V',
                'loose_symbol' => 'KT',
            ],
            [
                'package_unit' => 'Package',
                'loose_unit' => 'Loose Package',
                'package_symbol' => 'P',
                'loose_symbol' => 'LP',
            ],
            [
                'package_unit' => 'Other',
                'loose_unit' => 'MiniOther',
                'package_symbol' => 'OT',
                'loose_symbol' => 'MOT',
            ],
        ];

        Unit::insert($data);
    }
}
