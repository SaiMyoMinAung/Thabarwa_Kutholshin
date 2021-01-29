<?php

namespace App\Status;

use MyCLabs\Enum\Enum;

/**
 * Unit enum
 * @method static Unit()
 */
class Unit extends Enum
{
    // Unit
    private const UNIT = [
        [
            'label' => 'Other',
            'symbol' => 'OT',
            'code' => 1
        ],
        [
            'label' => 'VISS',
            'symbol' => 'VISS',
            'code' => 2
        ],
        [
            'label' => 'Package',
            'symbol' => 'Package',
            'code' => 3
        ],
        [
            'label' => 'Litre',
            'symbol' => 'L',
            'code' => 4
        ],
    ];

    public static function advanceSearch($search)
    {
        $types = self::toArray();
        $found = [];

        foreach ($types["UNIT"] as $type) {
            $check = array_search($search, $type, true);
            if ($check) {
                $found = $type;
                break;
            }
        }

        return $found;
    }
}
