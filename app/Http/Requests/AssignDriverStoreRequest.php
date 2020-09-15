<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\AssignDriverDTO;
use Illuminate\Foundation\Http\FormRequest;

class AssignDriverStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stepper' => 'numeric|max:999999999',
            'pickedup_driver_id' => 'required|numeric|max:999999999',
            'is_pickingup' => 'nullable|numeric|max:999999999',
        ];
    }

    public function assignDriverData()
    {
        return new AssignDriverDTO([
            'pickedup_driver_id' => $this->input('pickedup_driver_id'),
            'is_pickingup' => $this->input('is_pickingup') ?? 0,
        ]);
    }

    public function getStepper()
    {
        return $this->input('stepper');
    }
}
