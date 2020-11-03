<?php

namespace App\Status;

use MyCLabs\Enum\Enum;

/**
 * DonatedItemStatus enum
 * @method static DonatedItemStatus NEW_STATE()
 * @method static DonatedItemStatus CONFIRMED()
 * @method static DonatedItemStatus CANCELLED()
 * @method static DonatedItemStatus ASSIGNED_DRIVER()
 * @method static DonatedItemStatus REASSIGNED_DRIVER()
 * @method static DonatedItemStatus PICKINGUP()
 * @method static DonatedItemStatus DONE_PICKINGUP()
 * @method static DonatedItemStatus ASSIGNED_STORE_KEEPER()
 * @method static DonatedItemStatus REASSIGNED_STORE_KEEPER()
 * @method static DonatedItemStatus STORING()
 * @method static DonatedItemStatus DONE_STORING()
 * @method static DonatedItemStatus REQUIRED_REPAIR()
 * @method static DonatedItemStatus NOT_REQUIRED_REPAIR()
 * @method static DonatedItemStatus ASSIGNED_REPAIRER()
 * @method static DonatedItemStatus REASSIGNED_REPAIRER()
 * @method static DonatedItemStatus REPAIRING()
 * @method static DonatedItemStatus DONE_REPAIRING()
 * @method static DonatedItemStatus ASSIGNED_DELIVER()
 * @method static DonatedItemStatus REASSIGNED_DELIVER()
 * @method static DonatedItemStatus DELIVERING()
 * @method static DonatedItemStatus DONE_DELIVERING()
 */
class DonatedItemStatus extends Enum
{
    private const NEW_STATE = 0;
    private const CONFIRMED = 1;
    private const CANCELLED = 2;
    private const ASSIGNED_DRIVER = 3;
    private const REASSIGNED_DRIVER = 4;
    private const PICKINGUP = 5;
    private const DONE_PICKINGUP = 6;
    private const ASSIGNED_STORE_KEEPER = 7;
    private const REASSIGNED_STORE_KEEPER = 8;
    private const STORING = 9;
    private const DONE_STORING = 10;
    private const REQUIRED_REPAIR = 11;
    private const NOT_REQUIRED_REPAIR = 12;
    private const ASSIGNED_REPAIRER = 13;
    private const REASSIGNED_REPAIRER = 14;
    private const REPAIRING = 15;
    private const DONE_REPAIRING = 16;
    private const ASSIGNED_DELIVER = 17;
    private const REASSIGNED_DELIVER = 18;
    private const DELIVERING = 19;
    private const DONE_DELIVERING = 20;
}
