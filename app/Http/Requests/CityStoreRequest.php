<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityStoreRequest extends FormRequest
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
            'state_region_id' => 'required|numeric|max:99999999',
            'name' => 'required|max:255|unique:cities,name',
            'is_available' => 'required|numeric|max:1'
        ];
    }
}
