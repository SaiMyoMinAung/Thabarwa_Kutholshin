<?php

use App\Admin;
use App\Office;
use App\TypeOfAdmin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Constants\SuperRoleConstant;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => SuperRoleConstant::SuperRole,
            'guard_name' => 'admin'
        ]);

        $admin = new Admin();
        $admin->name = 'Ku Thol Shin (Super Role)';
        $admin->email = 'saimyominaung2110@gmail.com';
        $admin->phone = '0977777777';
        $admin->password = bcrypt('123456');
        $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        $admin->save();

        $admin->syncRoles($role);

        // $admin = new Admin();
        // $admin->name = 'Ku Thol Shin (Donation Record Admin)';
        // $admin->email = 'admin@kutholshin2.com';
        // $admin->phone = '09799999999';
        // $admin->password = bcrypt('123456');
        // $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        // $admin->save();

        // $admin = new Admin();
        // $admin->name = 'Ku Thol Shin (Setting Admin)';
        // $admin->email = 'admin@kutholshin3.com';
        // $admin->phone = '09799999991';
        // $admin->password = bcrypt('123456');
        // $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        // $admin->save();

        // $admin = new Admin();
        // $admin->name = 'Admin Office Two (Internal Donated Item Record Admin)';
        // $admin->email = 'admin@officeTwo.com';
        // $admin->phone = '0977774455';
        // $admin->password = bcrypt('123456');
        // $admin->office_id = Office::where('name', OFFICE_TWO)->first()->id;
        // $admin->save();

        // $admin = new Admin();
        // $admin->name = 'Admin Office One (Internal Donated Item Record Admin)';
        // $admin->email = 'admin@officeOne.com';
        // $admin->phone = '0977714455';
        // $admin->password = bcrypt('123456');
        // $admin->office_id = Office::where('name', OFFICE_ONE)->first()->id;
        // $admin->save();
    }
}
