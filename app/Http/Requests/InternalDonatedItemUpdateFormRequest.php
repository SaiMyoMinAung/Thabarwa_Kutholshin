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
            'socket_qty' => 'required|numeric|max:100000',
            'socket_per_package' => 'required|numeric|max:100000',
            'unit_id' => 'required|numeric|max:20',
            'item_type_id' => 'required|numeric',
            'item_sub_type_id' => 'required|numeric',
            'remark' => "required|string|max:1000",
            'is_confirmed' => "required|boolean"
        ];
    }

    public function messages()
    {
        return [
            'package_qty.required' => 'Please Fill Package Qty.',
            'package_qty.numeric' => 'Please Fill Number Only.',
            'socket_qty.required' => 'Please Fill Socket Qty.',
            'socket_qty.numeric' => 'Please Fill Number Only.',
            'unit_id.required' => 'Please Fill Unit.',
            'unit_id.numeric' => 'Please Fill Number Only.',
            'item_type_id.required' => 'Please Select Item Type.',
            'item_type_id.numeric' => 'Please Select Item Type.',
            'alms_round_id.required' => 'Please Select Alms Round.',
            'alms_round_id.numeric' => 'Please Select Alms Round.',
            'item_sub_type_id.required' => 'Please Select Item Sub Type.',
            'item_sub_type_id.numeric' => 'Please Select Item Sub Type.',
            'remark.required' => 'Please Fill Remark.',
        ];
    }

    public function internalDonatedItemData()
    {
        return new InternalDonatedItemUpdateDTO([
            'alms_round_id' => $this->input('alms_round_id'),
            'package_qty' => $this->input('package_qty'),
            'socket_qty' => $this->input('socket_qty'),
            'socket_per_package' => $this->input('socket_per_package'),
            'unit_id' => $this->input('unit_id'),
            'item_type_id' => $this->input('item_type_id'),
            'item_sub_type_id' => $this->input('item_sub_type_id'),
            'remark' => $this->input('remark'),
            'is_confirmed' => $this->input('is_confirmed'),
        ]);
    }
}
