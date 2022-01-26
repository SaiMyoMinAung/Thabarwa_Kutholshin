<?php

use App\Unit;
use Illuminate\Database\Seeder;

class MedicalUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // card အတွက် = ဆေးကဒ် (card) / ဆေးလုံး (tablet)
    // Bot အတ္ွက် = ဘော့ပြည့် (full bot) / ဘော့ (bot)
    // amp အန်းပျူ့ အတွက် = အန်းပျူ့ ကဒ် (amp card) / အန်းပျူးဆေးပုလင်း (amp bottle)
    // set အတွက် = ကာတွန် (carton) / ကာတွန် အပြည် (carton loose)
    // pcs အတွက် = pcs သေတ္တာ (pcs box) / pcs အပြည် (pcs loose)

        $data = [
            [
                'package_unit' => 'ဆေးကဒ်',
                'package_symbol' => 'card',
                'loose_unit' => 'ဆေးလုံး',
                'loose_symbol' => 'tablet',
            ],
            [
                'package_unit' => 'ဘော့ပြည့်',
                'package_symbol' => 'full bot',
                'loose_unit' => 'ဘော့',
                'loose_symbol' => 'bot',
            ],
            [
                'package_unit' => 'အန်းပျူ့ကဒ်',
                'package_symbol' => 'amp card',
                'loose_unit' => 'အန်းပျူ့ဆေးပုလင်း',
                'loose_symbol' => 'amp bottle',
            ],
            [
                'package_unit' => 'ကာတွန်',
                'package_symbol' => 'carton',
                'loose_unit' => 'ကာတွန် အပြည်',
                'loose_symbol' => 'carton loose',
            ],
            [
                'package_unit' => 'သေတ္တာ',
                'package_symbol' => 'pcs box',
                'loose_unit' => 'အပြည်',
                'loose_symbol' => 'pcs loose',
            ],
            
        ];

        Unit::insert($data);
    }
}
