<?php

use App\ItemType;
use Illuminate\Database\Seeder;

class ItemTypeSeeder extends Seeder
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
                'type' => ['name' => ITEM_TYPE_ONE],
                'sub' => ITEM_SUB_TYPE_ONE
            ],
            [
                'type' => ['name' => ITEM_TYPE_TWO],
                'sub' => ITEM_SUB_TYPE_TWO
            ],
            [
                'type' => ['name' => ITEM_TYPE_THREE],
                'sub' => ITEM_SUB_TYPE_THREE
            ],
        ];
        foreach ($data as $d) {
            $type = ItemType::create($d['type']);
            $type->itemSubTypes()->createMany($d['sub']);
        }
    }
}
