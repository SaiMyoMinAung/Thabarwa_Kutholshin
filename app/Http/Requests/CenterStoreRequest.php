<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CenterStoreRequest extends FormRequest
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
            'city_id' => 'required|numeric|max:99999999',
            'name' => 'required|max:255|unique:centers,name',
            'is_available' => 'required|numeric|max:1'
        ];
    }


    public function messages()
    {
        return [
            'city_id.required' => trans('custom-vali.city_id_required'),
            'name.required' => trans('custom-vali.name_required'),
            'is_available.required' => trans('custom-vali.is_available_required'),
        ];
    }
}
