<?php

namespace App\Rules;

use App\Contribution;
use Illuminate\Contracts\Validation\Rule;

class ReceiveOfficeCanChange implements Rule
{
    public $contribution;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($contribution)
    {
        $this->contribution = $contribution;
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
        if ($this->contribution->receive_office_id != $value) {
            return !$this->contribution->atLeastOneItemConfirmed($this->contribution);
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Item Is Confirmed To This Office.So Cannot Change To Other Office.';
    }
}
