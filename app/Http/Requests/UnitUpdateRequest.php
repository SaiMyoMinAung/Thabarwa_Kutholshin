<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitUpdateRequest extends FormRequest
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
        $id = $this->unit->id;

        return [
            "package_symbol" => "required|max:255|unique:units,package_symbol,$id",
            "package_unit" => "required|max:255|unique:units,package_unit,$id",
            "loose_symbol" => "required|max:255|unique:units,loose_symbol,$id",
            "loose_unit" => "required|max:255|unique:units,loose_unit,$id",
        ];
    }
}
