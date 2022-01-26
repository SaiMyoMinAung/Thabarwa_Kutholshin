<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DTO\InternalDonatedItemUpdateDTO;

class InternalDonatedItemUpdateFormRequest extends FormRequest
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
            'alms_round_id' => 'required|numeric',
            'package_qty' => 'required|numeric|max:100000',
            'sacket_qty' => 'required|numeric|max:100000',
            'item_sub_type_id' => 'required|numeric',
            'is_confirmed' => "required|boolean"
        ];
    }

    public function messages()
    {
        return [
            'package_qty.required' => 'Please Fill Package Qty.',
            'package_qty.numeric' => 'Please Fill Number Only.',
            
            'alms_round_id.required' => 'Please Select Alms Round.',
            'alms_round_id.numeric' => 'Please Select Alms Round.',

            'item_sub_type_id.required' => 'Please Select Item Sub Type.',
            'item_sub_type_id.numeric' => 'Please Select Item Sub Type.'
        ];
    }

    public function internalDonatedItemData()
    {
        return new InternalDonatedItemUpdateDTO([
            'alms_round_id' => $this->input('alms_round_id'),
            'package_qty' => $this->input('package_qty'),
            'sacket_qty' => $this->input('sacket_qty'),
            'item_sub_type_id' => $this->input('item_sub_type_id'),
            'is_confirmed' => $this->input('is_confirmed'),
        ]);
    }
}
