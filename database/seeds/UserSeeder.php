<?php

use App\City;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = TEST_USER;
        $user->email = TEST_USER_EMAIL;
        $user->phone = TEST_USER_PHONE;
        $user->password = bcrypt('123456');
        $user->city_id = City::where('name', CITY_ONE)->first()->id;
        $user->save();
    }
}
