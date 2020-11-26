<?php

namespace App\Status;

use MyCLabs\Enum\Enum;

/**
 * RequestedItemStatus enum
 * @method static DonatedItemStatus NEW_REQUEST()
 * @method static DonatedItemStatus ASSIGNED_DELIVER()
 * @method static DonatedItemStatus REASSIGNED_DELIVER()
 * @method static DonatedItemStatus DELIVERING()
 * @method static DonatedItemStatus DONE_DELIVERING()
 * @method static DonatedItemStatus COMPLETE()
 * @method static DonatedItemStatus INCOMPLETE()
 * @method static DonatedItemStatus CANCELLED()
 */
class RequestedItemStatus extends Enum
{
    // Requested Item Status
    private const NEW_REQUEST = 1;
    private const ASSIGNED_DELIVER = 2;
    private const REASSIGNED_DELIVER = 3;
    private const DELIVERING = 4;
    private const DONE_DELIVERING = 5;
    private const COMPLETE = 6;
    private const INCOMPLETE = 7;
    private const CANCELLED = 8;
    
}
