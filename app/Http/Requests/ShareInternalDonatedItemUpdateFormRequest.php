<?php

namespace App\Http\Requests;

use Exception;
use Carbon\Carbon;
use App\ItemSubType;
use App\Status\RequestableType;
use App\Services\MainCalculation;
use App\Rules\CheckLeftItemForUpdate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\DTO\ShareInternalDonatedItemDTO;

class ShareInternalDonatedItemUpdateFormRequest extends FormRequest
{
    public $mainCalculation;

    public function __construct()
    {
        $this->mainCalculation = new MainCalculation;
    }
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
        $shareInternalDonatedItem = $this->share_internal_donated_item;

        return [
            'item_sub_type_id' => ['required', 'numeric'],
            'package_qty' => [
                'required', 'numeric', 'max:100000',
                new CheckLeftItemForUpdate(
                    $this->input('item_sub_type_id'),
                    $this->input('package_qty'),
                    $this->input('sacket_qty'),
                    $shareInternalDonatedItem
                )
            ],
            'sacket_qty' => [
                'required', 'numeric', 'max:100000',
                new CheckLeftItemForUpdate(
                    $this->input('item_sub_type_id'),
                    $this->input('package_qty'),
                    $this->input('sacket_qty'),
                    $shareInternalDonatedItem
                )
            ],
            'requestable_type' => ['required'],
            'requestable_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'package_qty.required' => 'Please Fill Package Qty.',
            'package_qty.numeric' => 'Please Fill Number Only.',

            'sacket_qty.required' => 'Please Fill Sacket Qty.',
            'sacket_qty.numeric' => 'Please Fill Number Only.',

            'item_sub_type_id.required' => 'Please Select Item Sub Type.',
            'item_sub_type_id.numeric' => 'Please Select Item Sub Type.',

            'requestable_type' => 'Please Select Requestable Type',
            'requestable_id' => 'Please Select Requestable Person',
        ];
    }

    public function shareInternalDonatedItemData()
    {
        try {
            $type = call_user_func(array(RequestableType::class, $this->input('requestable_type')));
        } catch (Exception $e) {
            report($e);
            $error = ValidationException::withMessages([
                'cannot_found_type_error' => ['Not Found Requestable Type'],
            ]);
            throw $error;
        }

        return new ShareInternalDonatedItemDTO([
            'date' => Carbon::now(),
            'sacket_qty' => $this->mainCalculation->changeAllToSackets($this->input('item_sub_type_id'), $this->input('package_qty'), $this->input('sacket_qty')),

            'item_type_id' => ItemSubType::find($this->input('item_sub_type_id'))->itemType->id,
            'item_sub_type_id' => $this->input('item_sub_type_id'),

            'requestable_type' =>  $type,
            'requestable_id' => $this->input('requestable_id'),

            'admin_id' => auth()->user()->id,
            'office_id' => $this->input('office_id')
        ]);
    }
}
