<?php

use App\TypeOfAdmin;
use Illuminate\Database\Seeder;

class TypeOfAdminSeeder extends Seeder
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
                'name' => DONATED_ITEM_RECORD_ADMIN,
            ],
            [
                'name' => DONATION_RECORD_ADMIN,
            ],
            [
                'name' => SETTING
            ]
        ];

        TypeOfAdmin::insert($data);
    }
}
