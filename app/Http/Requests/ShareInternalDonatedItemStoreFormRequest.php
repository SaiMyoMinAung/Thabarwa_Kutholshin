<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DTO\ShareInternalDonatedItemDTO;
use App\Rules\CheckLeftItem;

class ShareInternalDonatedItemStoreFormRequest extends FormRequest
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
            'item_type_id' => ['required', 'numeric'],
            'item_sub_type_id' => ['required', 'numeric'],
            'socket_qty' => [
                'required', 'numeric', 'max:100000',
                new CheckLeftItem($this->input('item_sub_type_id'), $this->input('socket_qty'))
            ],
            'requestable_type' => ['required'],
            'requestable_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'socket_qty.required' => 'Please Fill Socket Qty.',
            'socket_qty.numeric' => 'Please Fill Number Only.',
            'item_type_id.required' => 'Please Select Item Type.',
            'item_type_id.numeric' => 'Please Select Item Type.',
            'item_sub_type_id.required' => 'Please Select Item Sub Type.',
            'item_sub_type_id.numeric' => 'Please Select Item Sub Type.',
            'requestable_type' => 'Please Select Requestable Type',
            'requestable_id' => 'Please Select Requestable Person',
        ];
    }

    public function shareInternalDonatedItemData()
    {
        return new ShareInternalDonatedItemDTO([
            'date' => Carbon::now(),
            'socket_qty' => $this->input('socket_qty'),

            'item_type_id' => $this->input('item_type_id'),
            'item_sub_type_id' => $this->input('item_sub_type_id'),

            'requestable_type' =>  call_user_func(['App\\Status\\RequestableType', $this->input('requestable_type')]),
            'requestable_id' => $this->input('requestable_id'),

            'admin_id' => auth()->user()->id
        ]);
    }
}
