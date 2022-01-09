<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\InternalDonatedItemDTO;
use App\Status\InternalDonatedItemStatus;
use Illuminate\Foundation\Http\FormRequest;

class InternalDonatedItemStoreFormRequest extends FormRequest
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
            'package_qty' => 'required|numeric|max:100000',
            'socket_qty' => 'required|numeric|max:100000',
            'socket_per_package' => 'required|numeric|max:100000',
            'unit_id' => 'required|numeric|max:20',
            'item_type_id' => 'required|numeric',
            'alms_round_id' => 'required|numeric',
            'item_sub_type_id' => 'required|numeric',
            'remark' => "required|string|max:1000",
            'is_confirmed' => "required|boolean"
        ];
    }

    public function messages()
    {
        return [
            'package_qty.required' => trans('custom-vali.package_qty_required'),
            'package_qty.numeric' => trans('custom-vali.package_qty_numeric'),
            'socket_qty.required' => trans('custom-vali.socket_qty_required'),
            'socket_qty.numeric' => trans('custom-vali.socket_qty_numeric'),
            'unit_id.required' => trans('custom-vali.unit_id_required'),
            'unit_id.numeric' => trans('custom-vali.unit_id_numeric'),
            'item_type_id.required' => trans('custom-vali.item_type_id_required'),
            'item_type_id.numeric' => trans('custom-vali.item_type_id_numeric'),
            'alms_round_id.required' => trans('custom-vali.alms_round_id_required'),
            'alms_round_id.numeric' => trans('custom-vali.alms_round_id_numeric'),
            'item_sub_type_id.required' => trans('custom-vali.item_sub_type_id_required'),
            'item_sub_type_id.numeric' => trans('custom-vali.item_sub_type_id_numeric'),
            'remark.required' => trans('custom-vali.remark_required'),
        ];
    }

    public function internalDonatedItemData()
    {
        return new InternalDonatedItemDTO([
            'package_qty' => $this->input('package_qty'),
            'socket_qty' => $this->input('socket_qty'),
            'socket_per_package' => $this->input('socket_per_package'),
            'unit_id' => $this->input('unit_id'),
            'item_type_id' => $this->input('item_type_id'),
            'alms_round_id' => $this->input('alms_round_id'),
            'item_sub_type_id' => $this->input('item_sub_type_id'),
            'remark' => $this->input('remark'),
            'status' => InternalDonatedItemStatus::advanceSearch('Available')["code"],
            'is_confirmed' => $this->input('is_confirmed'),
            'office_id' => auth()->user()->office->id,
            'admin_id' => auth()->user()->id
        ]);
    }
}
