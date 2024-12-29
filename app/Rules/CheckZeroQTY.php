<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckZeroQTY implements Rule
{
    public $sac_qty, $pac_qty;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($sac_qty, $pac_qty)
    {
        $this->sac_qty = $sac_qty;
        $this->pac_qty = $pac_qty;
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
        return $this->sac_qty != 0 ||  $this->pac_qty != 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('custom-vali.greater_than_one');
    }
}
