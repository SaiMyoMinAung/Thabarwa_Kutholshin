<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WardUpdateRequest extends FormRequest
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
        $id = $this->ward->id;
        return [
            'center_id' => 'required|numeric|max:99999999',
            'name' => "required|max:255|unique:wards,name,$id",
            'is_available' => 'required|numeric|max:1'
        ];
    }
}
