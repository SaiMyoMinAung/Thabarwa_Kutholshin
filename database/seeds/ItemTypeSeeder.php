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
            [
                'type' => ['name' => ITEM_TYPE_FOUR],
                'sub' => ITEM_SUB_TYPE_FOUR
            ],
            [
                'type' => ['name' => ITEM_TYPE_FIVE],
                'sub' => ITEM_SUB_TYPE_FIVE
            ],
            [
                'type' => ['name' => ITEM_TYPE_SIX],
                'sub' => ITEM_SUB_TYPE_SIX
            ],
            [
                'type' => ['name' => ITEM_TYPE_SEVEN],
                'sub' => ITEM_SUB_TYPE_SEVEN
            ],
        ];
        foreach ($data as $d) {
            $type = ItemType::create($d['type']);
            $type->itemSubTypes()->createMany($d['sub']);
        }
    }
}
