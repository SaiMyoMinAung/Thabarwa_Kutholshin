<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\RequestedItemDTO;
use App\Rules\CheckQTY;
use App\Status\RequestedItemStatus;
use Illuminate\Foundation\Http\FormRequest;

class RequestedItemStoreRequest extends FormRequest
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
            'requestable_id' => 'required|numeric|max:99999999',
            'requestable_type' => 'required|max:10',
            'qty' => ['required', 'numeric', 'max:99999', new CheckQTY($this->donated_item->uuid)]
        ];
    }

    public function requestedItemData()
    {
        return new RequestedItemDTO([
            'request_no' => 0,
            'status' => RequestedItemStatus::NEW_REQUEST(),
            'state_class' => 'App\\State\\ManageRequest\\NewRequestState',
            'requestable_id' => $this->input('requestable_id'),
            'requestable_type' => call_user_func(['App\Status\RequestableType', $this->input('requestable_type')]),
            'qty' => $this->input('qty')
        ]);
    }
}
