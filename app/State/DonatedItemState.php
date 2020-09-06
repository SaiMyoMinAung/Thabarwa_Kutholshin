<?php

namespace App\State;

use App\DonatedItem;

abstract class DonatedItemState
{
    /** @var DonatedItem */
    protected $donatedItem;

    public function __construct(DonatedItem $donatedItem)
    { /* … */ }

    abstract public function mustBePaid(): bool;

    abstract public function colour(): string;
}
