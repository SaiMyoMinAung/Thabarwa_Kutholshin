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

    abstract public function canManage(): bool;

    abstract public function canAssignDriver(): bool;

    abstract public function canArriveAtOffice(): bool;

    abstract public function status(): string;
}
