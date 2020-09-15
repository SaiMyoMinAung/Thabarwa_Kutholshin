<?php

namespace App\State;

use App\State\DonatedItemState;

class PendingState extends DonatedItemState
{
    public function status(): string
    {
        return 'pending';
    }

    public function canManage(): bool
    {
        return $this->donatedItem->is_confirm_by_donor;
    }

    public function canAssignDriver(): bool
    {
        return ($this->donatedItem->is_confirm_by_donor &&
            !$this->donatedItem->is_pickingup &&
            !$this->donatedItem->is_arrive_at_office &&
            !$this->donatedItem->is_need_repairing &&
            !$this->donatedItem->is_repairing &&
            !$this->donatedItem->is_repairing_finish &&
            !$this->donatedItem->is_deliver &&
            !$this->donatedItem->is_complete);
    }

    public function canArriveAtOffice(): bool
    {
        return ($this->donatedItem->is_confirm_by_donor &&
            $this->donatedItem->is_pickingup &&
            !$this->donatedItem->is_arrive_at_office &&
            !$this->donatedItem->is_need_repairing &&
            !$this->donatedItem->is_repairing &&
            !$this->donatedItem->is_repairing_finish &&
            !$this->donatedItem->is_deliver &&
            !$this->donatedItem->is_complete);
    }
}
