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
                'name' => ITEM_TYPE_ONE,
            ],
            [    
                'name' => ITEM_TYPE_TWO,
            ],
            [    
                'name' => ITEM_TYPE_THREE,
            ],
        ];

        ItemType::insert($data);
    }
}
