<?php

namespace App\Rules;

use App\ItemSubType;
use App\Services\MainCalculation;
use Illuminate\Contracts\Validation\Rule;

class CheckLeftItemForUpdate implements Rule
{
    public $mainCalculation, $item_sub_type_id, $request_sacket_qty, $request_package_qty, $shareInternalDonatedItem;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($item_sub_type_id, $request_package_qty, $request_sacket_qty, $shareInternalDonatedItem)
    {
        $this->mainCalculation = new MainCalculation;
        $this->item_sub_type_id = $item_sub_type_id;
        $this->request_sacket_qty = $request_sacket_qty;
        $this->request_package_qty = $request_package_qty;
        $this->shareInternalDonatedItem = $shareInternalDonatedItem;
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
        if ($this->request_sacket_qty == 0 && $this->request_package_qty == 0) {
            return false;
        }

        return $this->mainCalculation->canShareThisAmountForUpdate(
            $this->item_sub_type_id,
            $this->request_package_qty,
            $this->request_sacket_qty,
            $this->shareInternalDonatedItem
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cannot Request This Quantity.';
    }
}
