<?php

namespace App\State\Online;

use App\State\DonatedItemState;
use App\Status\DonatedItemStatus;

class CompleteState extends DonatedItemState
{
    public function status()
    {
        return DonatedItemStatus::COMPLETE();
    }

    public function canChangeToIncompleteState(): bool
    {
        return ($this->donatedItem->is_done_pickingup
                && $this->donatedItem->is_done_storing
                && $this->donatedItem->is_complete)
            || ($this->donatedItem->is_done_pickingup
                && $this->donatedItem->is_done_storing
                && !$this->donatedItem->is_required_repairing
                && !$this->donatedItem->is_done_repairing
                && $this->donatedItem->repaired_volunteer_id == null);
    }
}
