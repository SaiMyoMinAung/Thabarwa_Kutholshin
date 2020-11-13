<?php


use App\Office;
use App\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
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
                'name' => STORE_ONE,
                'office_id' => Office::where('name', OFFICE_ONE)->first()->id,
                'store_number' => rand(0, 100)
            ],
            [
                'uuid' => rand(0, 100000),
                'name' => STORE_TWO,
                'office_id' => Office::where('name', OFFICE_TWO)->first()->id,
                'store_number' => rand(0, 100)
            ]
        ];

        Store::insert($data);
    }
}
