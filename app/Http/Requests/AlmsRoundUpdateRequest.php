<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlmsRoundUpdateRequest extends FormRequest
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
        $id = $this->alms_round->id;

        return [
            'name' => "required|max:255|unique:alms_rounds,name,$id",
            'center_id' => "required|numeric"
        ];
    }
}
