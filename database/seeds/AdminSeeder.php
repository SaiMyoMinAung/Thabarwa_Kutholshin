<?php

use App\Admin;
use App\Office;
use App\StateRegion;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = 'Ku Thol Shin';
        $admin->email = 'admin@kutholshin.com';
        $admin->phone = '0977777777';
        $admin->password = bcrypt('123456');
        $admin->state_region_id = StateRegion::where('name', STATE_REGION_ONE)->first()->id;
        $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        $admin->save();
    }
}
