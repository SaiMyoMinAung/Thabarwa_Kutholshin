<?php


use App\Store;
use App\Box;
use Illuminate\Database\Seeder;

class BoxSeeder extends Seeder
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
                'uuid' => rand(0, 100000),
                'name' => BOX_ONE,
                'store_id' => Store::where('name', STORE_ONE)->first()->id,
                'box_number' => rand(0, 100)
            ],
            [
                'uuid' => rand(0, 100000),
                'name' => BOX_TWO,
                'store_id' => Store::where('name', STORE_TWO)->first()->id,
                'box_number' => rand(0, 100)
            ]
        ];

        Box::insert($data);
    }
}
