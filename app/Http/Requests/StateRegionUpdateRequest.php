<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRegionUpdateRequest extends FormRequest
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
        $id = $this->state_region->id;
        
        return [
            'name' => "required|max:255|unique:countries,name,$id",
            'code' => "required|max:9999999|numeric|unique:state_regions,code,$id",
            'country_id' => 'required|numeric|max:99999999',
            'is_available' => 'required|numeric|max:1'
        ];
    }
}
