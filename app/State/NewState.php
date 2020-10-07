<?php

namespace App\State;

use App\State\DonatedItemState;

class NewState extends DonatedItemState
{
    public function status(): string
    {
        return 'new';
    }

    public function canChangeConfirmedState(): bool
    {
        return $this->donatedItem->is_confirmed != 1;
    }

    // public function canAssignDriver(): bool
    // {
    //     return ($this->donatedItem->is_confirmed &&
    //         !$this->donatedItem->is_pickingup &&
    //         !$this->donatedItem->is_arrive_at_office &&
    //         !$this->donatedItem->is_need_repairing &&
    //         !$this->donatedItem->is_repairing &&
    //         !$this->donatedItem->is_repairing_finish &&
    //         !$this->donatedItem->is_deliver &&
    //         !$this->donatedItem->is_complete);
    // }

    // public function canArriveAtOffice(): bool
    // {
    //     return ($this->donatedItem->is_confirm_by_donor &&
    //         $this->donatedItem->is_pickingup &&
    //         !$this->donatedItem->is_arrive_at_office &&
    //         !$this->donatedItem->is_need_repairing &&
    //         !$this->donatedItem->is_repairing &&
    //         !$this->donatedItem->is_repairing_finish &&
    //         !$this->donatedItem->is_deliver &&
    //         !$this->donatedItem->is_complete);
    // }

    // public function canMake(): bool
    // {
    //     return true;
    // }
}
