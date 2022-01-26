<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemSubTypeStoreRequest extends FormRequest
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
            'name' => 'required|max:255|unique:item_sub_types,name',
            'item_type_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'sacket_per_package' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => trans('custom-vali.name_required'),

            'item_type_id.required' => trans('custom-vali.item_type_id_required'),
            'item_type_id.numeric' => trans('custom-vali.item_type_id_numeric'),

            'sacket_qty.required' => trans('custom-vali.sacket_qty_required'),
            'sacket_qty.numeric' => trans('custom-vali.sacket_qty_numeric'),

            'sacket_per_package.required' => trans('custom-vali.sacket_per_package_required'),
            'sacket_per_package.numeric' => trans('custom-vali.sacket_per_package_numeric'),

            'unit_id.required' => trans('custom-vali.unit_id_required'),
            'unit_id.numeric' => trans('custom-vali.unit_id_numeric'),

        ];
    }
}
