<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\AssignDeliverDTO;
use Illuminate\Foundation\Http\FormRequest;

class AssignDeliverStoreRequest extends FormRequest
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
            'delivered_volunteer_id' => 'required|numeric|max:999999999',
        ];
    }

    public function assignDeliverData()
    {
        return new AssignDeliverDTO([
            'delivered_volunteer_id' => $this->input('delivered_volunteer_id')
        ]);
    }
}
