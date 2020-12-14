<?php

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
        $yogi->phone = TEST_YOGI_PHONE;
        $yogi->password = bcrypt('123456');
        $yogi->ward_id = Ward::where('name',WARD_ONE)->first()->id;
        $yogi->save();
    }
}
