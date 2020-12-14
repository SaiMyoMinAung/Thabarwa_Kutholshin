<?php

use App\Admin;
use App\Office;
use App\TypeOfAdmin;
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
        $admin->name = 'Ku Thol Shin (Donated Item Record Admin)';
        $admin->email = 'admin@kutholshin.com';
        $admin->phone = '0977777777';
        $admin->password = bcrypt('123456');
        $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        $admin->is_super = true;
        $admin->type_of_admin_id = TypeOfAdmin::where('name', DONATED_ITEM_RECORD_ADMIN)->first()->id;
        $admin->save();

        $admin = new Admin();
        $admin->name = 'Ku Thol Shin (Donation Record Admin)';
        $admin->email = 'admin@kutholshin2.com';
        $admin->phone = '09799999999';
        $admin->password = bcrypt('123456');
        $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        $admin->is_super = false;
        $admin->type_of_admin_id = TypeOfAdmin::where('name', DONATION_RECORD_ADMIN)->first()->id;
        $admin->save();

        $admin = new Admin();
        $admin->name = 'Ku Thol Shin (Setting Admin)';
        $admin->email = 'admin@kutholshin3.com';
        $admin->phone = '09799999991';
        $admin->password = bcrypt('123456');
        $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        $admin->is_super = false;
        $admin->type_of_admin_id = TypeOfAdmin::where('name', SETTING)->first()->id;
        $admin->save();
    }
}
