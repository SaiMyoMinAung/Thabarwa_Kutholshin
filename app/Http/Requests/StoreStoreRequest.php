<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
            'office_id' => 'required|numeric|max:99999999',
            'name' => 'required|max:255|unique:stores,name',
            'store_number' => 'required|max:255|unique:stores,store_number',
        ];
    }
}
