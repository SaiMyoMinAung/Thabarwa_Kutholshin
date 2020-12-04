<?php

use App\KindOfDonation;
use Illuminate\Database\Seeder;

class KindOfDonationSeeder extends Seeder
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
                'name' => 'နဝကမ္မ အလှူ',
            ],
            [
                'name' => 'ဆန် အလှူ',
            ]
        ];

        KindOfDonation::insert($data);
    }
}
