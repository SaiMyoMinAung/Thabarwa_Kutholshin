<?php

namespace App\Status;

use MyCLabs\Enum\Enum;

/**
 * TypeOfMoney enum
 * @method static TypeOfMoney TYPE()
 */
class TypeOfMoney extends Enum
{
    // TypeOfMoney
    private const TYPE = [
        [
            'label' => 'Kyats',
            'symbol' => 'Ks',
            'code' => 1
        ],
        [
            'label' => 'Dollar',
            'symbol' => '$',
            'code' => 2
        ],
        [
            'label' => 'Euro',
            'symbol' => '€',
            'code' => 3
        ],
        [
            'label' => 'SGD',
            'symbol' => 'S$',
            'code' => 4
        ],
        [
            'label' => 'Bath',
            'symbol' => '฿',
            'code' => 5
        ],
        [
            'label' => 'Dong',
            'symbol' => '₫',
            'code' => 6
        ],
        [
            'label' => 'Rupee',
            'symbol' => '₹',
            'code' => 7
        ],

    ];

    public static function advanceSearch($search)
    {
        $types = self::toArray();
        $found = [];

        foreach ($types["TYPE"] as $type) {
            $check = array_search($search, $type, true);
            if ($check) {
                $found = $type;
                break;
            }
        }

        return $found;
    }
}
