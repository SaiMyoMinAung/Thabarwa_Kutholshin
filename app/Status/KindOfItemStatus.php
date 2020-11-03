<?php

namespace App\Status;

use MyCLabs\Enum\Enum;

/**
 * KingOfItemStatus enum
 * @method static KindOfItemStatus ONLINE()
 * @method static KindOfItemStatus INTERNAL()
 * * @method static KindOfItemStatus SHARE_AT_ONCE()
 */
class KindOfItemStatus extends Enum
{
    private const ONLINE = 0;
    private const INTERNAL = 1;
    private const  SHARE_AT_ONCE = 2;
}
