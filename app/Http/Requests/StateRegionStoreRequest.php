<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRegionStoreRequest extends FormRequest
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
            'name' => 'required|max:255|unique:state_regions,name',
            'code' => 'required|max:9999999|numeric|unique:state_regions,code',
            'country_id' => 'required|numeric|max:99999999',
            'is_available' => 'required|numeric|max:1'
        ];
    }
}