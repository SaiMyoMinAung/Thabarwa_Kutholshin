<?php

namespace App\Status;

use MyCLabs\Enum\Enum;

/**
 * InternalDonatedItemStatus enum
 * @method static InternalDonatedItemStatus TYPE()
 */
class InternalDonatedItemStatus extends Enum
{
    private const AVAILABLE = 'Available';
    private const COMPLETE = 'Complete';
    private const LOST = 'Lost';

    // InternalDonatedItemStatus
    private const TYPE = [
        [
            'label' => self::AVAILABLE,
            'code' => 1,
            'class' => 'badge badge-success'
        ],
        [
            'label' => self::COMPLETE,
            'code' => 2,
            'class' => 'badge badge-success'
        ],
        [
            'label' => self::LOST,
            'code' => 3,
            'class' => 'badge badge-danger'
        ],

    ];
    /**
     * Search Type
     *
     * @param [code or label] $search
     * @return array
     */
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
