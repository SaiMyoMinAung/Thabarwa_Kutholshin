<?php

namespace App\Rules;

use App\ItemSubType;
use Illuminate\Contracts\Validation\Rule;

class CheckLeftItem implements Rule
{
    public $itemSubType;
    public $request_socket_qty;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($item_sub_type_id, $request_socket_qty)
    {
        $this->itemSubType = ItemSubType::find($item_sub_type_id);
        $this->request_socket_qty = $request_socket_qty;
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
        $leftSocket = $this->itemSubType->left_sockets;
        $requestedSocket = $this->request_socket_qty;

        if ($requestedSocket == 0) {
            return false;
        }

        if ($leftSocket >= $requestedSocket) {
            return true;
        } else {
            return false;
        }
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
