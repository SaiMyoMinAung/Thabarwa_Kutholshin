<?php

namespace App\Http\Requests;

use Exception;
use App\Status\RequestableType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\DTO\InternalRequestedItemDTO;
use App\Rules\CheckLeftItem;

class InternalRequestedItemsStoreFormRequest extends FormRequest
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
            'requestable_type' => 'required|max:255',
            'requestable_id' => 'required|max:255',
            'request_package_qty' => ["required", "numeric", "max:1000", new CheckLeftItem($this->internal_donated_item, $this->input('request_package_qty'), $this->input('request_socket_qty'))],
            'request_socket_qty' => ["required", "numeric", "max:1000", new CheckLeftItem($this->internal_donated_item, $this->input('request_package_qty'), $this->input('request_socket_qty'))],
        ];
    }


    public function internalRequestedItemData()
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

        return new InternalRequestedItemDTO([
            'requestable_type' => $type,
            'requestable_id' => $this->input('requestable_id'),
            'package_qty' => $this->input('request_package_qty'),
            'socket_qty' => $this->input('request_socket_qty'),
            'admin_id' => auth()->user()->id,
        ]);
    }
}
