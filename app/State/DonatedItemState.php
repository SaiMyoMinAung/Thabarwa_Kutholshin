<?php

namespace App\State;

use App\DonatedItem;

abstract class DonatedItemState
{
    /** @var DonatedItem */
    public $donatedItem;

    public function __construct(DonatedItem $donatedItem)
    {
        $this->donatedItem = $donatedItem;
    }

    public function canChangeAssignedStoreKeeperState(): bool
    {
        return false;
    }

    public function canChangeAssignRepairerState(): bool
    {
        return false;
    }

    public function canChangeNotRequiredRepairState(): bool
    {
        return false;
    }

    public function canChangeToCompleteState(): bool
    {
        return false;
    }
    public function canChangeRequiredRepairState(): bool
    {
        return false;
    }
}
