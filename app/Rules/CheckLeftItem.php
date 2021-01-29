<?php

namespace App\Rules;

use App\InternalDonatedItem;
use Illuminate\Contracts\Validation\Rule;

class CheckLeftItem implements Rule
{
    public $internalDonatedItem;
    public $request_package_qty;
    public $request_socket_qty;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(InternalDonatedItem $internalDonatedItem, $request_package_qty, $request_socket_qty)
    {
        $this->internalDonatedItem = $internalDonatedItem;
        $this->request_package_qty = $request_package_qty;
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
        $leftSocket = $this->internalDonatedItem->left_sockets;
        $requestedSocket = ($this->internalDonatedItem->socket_per_package * $this->request_package_qty) + $this->request_socket_qty;

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
        return 'Cannot Request This Amount.';
    }
}
