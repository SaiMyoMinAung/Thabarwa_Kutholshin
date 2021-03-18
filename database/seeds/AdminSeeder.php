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
        $admin->email = 'saimyominaung2110@gmail.com';
        $admin->phone = '0977777777';
        $admin->password = bcrypt('123456');
        $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        $admin->is_super = true;
        $admin->is_regional_admin = true;
        $admin->save();

        $admin = new Admin();
        $admin->name = 'Ku Thol Shin (Donation Record Admin)';
        $admin->email = 'admin@kutholshin2.com';
        $admin->phone = '09799999999';
        $admin->password = bcrypt('123456');
        $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        $admin->is_super = false;
        $admin->is_regional_admin = false;
        $admin->save();

        $type_of_admin_ids = TypeOfAdmin::where('name', DONATION_RECORD_ADMIN)->pluck('id');
        $admin->typeOfAdmins()->sync($type_of_admin_ids);

        $admin = new Admin();
        $admin->name = 'Ku Thol Shin (Setting Admin)';
        $admin->email = 'admin@kutholshin3.com';
        $admin->phone = '09799999991';
        $admin->password = bcrypt('123456');
        $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        $admin->is_super = false;
        $admin->is_regional_admin = false;
        $admin->save();

        $type_of_admin_ids = TypeOfAdmin::where('name', SETTING)->pluck('id');
        $admin->typeOfAdmins()->sync($type_of_admin_ids);

        $admin = new Admin();
        $admin->name = 'Admin Office Two (Internal Donated Item Record Admin)';
        $admin->email = 'admin@officeTwo.com';
        $admin->phone = '0977774455';
        $admin->password = bcrypt('123456');
        $admin->office_id = Office::where('name', OFFICE_TWO)->first()->id;
        $admin->is_super = false;
        $admin->is_regional_admin = false;
        $admin->save();

        $type_of_admin_ids = TypeOfAdmin::where('name', INTERNAL_DONATED_ITEM_RECORD_ADMIN)->pluck('id');
        $admin->typeOfAdmins()->sync($type_of_admin_ids);

        $admin = new Admin();
        $admin->name = 'Admin Office One (Internal Donated Item Record Admin)';
        $admin->email = 'admin@officeOne.com';
        $admin->phone = '0977714455';
        $admin->password = bcrypt('123456');
        $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        $admin->is_super = false;
        $admin->is_regional_admin = false;
        $admin->save();

        $type_of_admin_ids = TypeOfAdmin::where('name', INTERNAL_DONATED_ITEM_RECORD_ADMIN)->pluck('id');
        $admin->typeOfAdmins()->sync($type_of_admin_ids);
    }
}
