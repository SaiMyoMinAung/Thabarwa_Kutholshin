<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class DeliveringState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::DELIVERING();
    }

    public function canChangeDoneDeliveringState(): bool
    {
        return $this->donatedItem->delivered_volunteer_id != null &&
            $this->donatedItem->is_delivering == 1;
    }
}
