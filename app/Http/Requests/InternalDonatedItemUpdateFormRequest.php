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
            'name' => 'required|max:255',
            'package_qty' => 'required|numeric|max:100000',
            'socket_qty' => 'required|numeric|max:100000',
            'socket_per_package' => 'required|numeric|max:100000',
            'unit' => 'required|numeric|max:20',
            'item_type_id' => 'required|numeric',
            'remark' => "required|string|max:1000",
            'is_confirmed' => "required|boolean"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Fill Name.',
            'name.max' => 'Name is Too Long!',
            'package_qty.required' => 'Please Fill Package Qty.',
            'package_qty.numeric' => 'Please Fill Number Only.',
            'socket_qty.required' => 'Please Fill Socket Qty.',
            'socket_qty.numeric' => 'Please Fill Number Only.',
            'unit.required' => 'Please Fill Unit.',
            'unit.numeric' => 'Please Fill Number Only.',
            'item_type_id.required' => 'Please Select Item Type.',
            'item_type_id.numeric' => 'Please Select Item Type.',
            'remark.required' => 'Please Fill Remark.',
        ];
    }

    public function internalDonatedItemData()
    {
        return new InternalDonatedItemUpdateDTO([
            'name' => $this->input('name'),
            'package_qty' => $this->input('package_qty'),
            'socket_qty' => $this->input('socket_qty'),
            'socket_per_package' => $this->input('socket_per_package'),
            'unit' => $this->input('unit'),
            'item_type_id' => $this->input('item_type_id'),
            'remark' => $this->input('remark'),
            'is_confirmed' => $this->input('is_confirmed'),
        ]);
    }
}
