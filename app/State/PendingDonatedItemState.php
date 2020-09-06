<?php

namespace App\State;

use App\State\DonatedItemState;

class PendingDonatedItemState extends DonatedItemState
{
    public function colour(): string
    {
        return 'orange';
    }

    public function mustBePaid(): bool
    {
        return true;
        // return $this->invoice->total_price > 0
        //     && $this->invoice->type->equals(InvoiceType::DEBIT());
    }
}
