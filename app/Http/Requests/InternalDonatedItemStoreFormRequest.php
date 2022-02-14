<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DTO\InternalDonatedItemDTO;
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
            'sacket_qty' => 'required|numeric|max:100000',
            'alms_round_id' => 'required|numeric',
            'item_sub_type_id' => 'required|numeric',
            'is_confirmed' => "required|boolean"
        ];
    }

    public function messages()
    {
        return [
            'package_qty.required' => trans('custom-vali.package_qty_required'),
            'package_qty.numeric' => trans('custom-vali.package_qty_numeric'),

            'sacket_qty.required' => trans('custom-vali.sacket_qty_required'),
            'sacket_qty.numeric' => trans('custom-vali.sacket_qty_numeric'),

            'alms_round_id.required' => trans('custom-vali.alms_round_id_required'),
            'alms_round_id.numeric' => trans('custom-vali.alms_round_id_numeric'),

            'item_sub_type_id.required' => trans('custom-vali.item_sub_type_id_required'),
            'item_sub_type_id.numeric' => trans('custom-vali.item_sub_type_id_numeric'),
        ];
    }

    public function internalDonatedItemData()
    {
        return new InternalDonatedItemDTO([
            'date' => Carbon::now()->format('Y-m-d'),
            'package_qty' => $this->input('package_qty'),
            'sacket_qty' => $this->input('sacket_qty'),
            'alms_round_id' => $this->input('alms_round_id'),
            'item_sub_type_id' => $this->input('item_sub_type_id'),
            'is_confirmed' => $this->input('is_confirmed'),
            'office_id' => auth()->user()->office->id,
            'admin_id' => auth()->user()->id
        ]);
    }
}
