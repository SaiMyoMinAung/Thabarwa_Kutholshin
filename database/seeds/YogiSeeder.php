<?php

use App\City;
use App\Ward;
use App\Yogi;
use Illuminate\Database\Seeder;

class YogiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $yogi = new Yogi();
        $yogi->name = TEST_YOGI;
        $yogi->email = TEST_YOGI_EMAIL;
        $yogi->phone = TEST_YOGI_PHONE;
        $yogi->password = bcrypt('123456');
        $yogi->city_id = City::where('name', CITY_ONE)->first()->id;
        $yogi->ward_id = Ward::where('name',WARD_ONE)->first()->id;
        $yogi->save();
    }
}
