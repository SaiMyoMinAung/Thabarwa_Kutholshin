<?php

namespace App\Rules;

use App\DonatedItem;
use App\Status\RequestedItemStatus;
use Illuminate\Contracts\Validation\Rule;

class CheckQTY implements Rule
{
    public $uuid;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $donatedItem = DonatedItem::where('uuid', $this->uuid)->firstOrFail();
        $left_item_qty = $donatedItem->qty - $donatedItem->requestedItems->where('status', '!=', RequestedItemStatus::CANCELLED())->sum('qty');
        return $value <= $left_item_qty;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Item Is Not Left.';
    }
}
