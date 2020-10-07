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
}
