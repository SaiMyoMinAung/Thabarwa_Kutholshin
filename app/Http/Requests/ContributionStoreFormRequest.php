<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\ContributionDTO;
use Illuminate\Foundation\Http\FormRequest;

class ContributionStoreFormRequest extends FormRequest
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
            'name' => 'required|max:255',
            'receive_office_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Fill Name.',
            'name.max' => 'Name is Too Long!',
            'receive_office_id.required' => 'Please Select Receive Office.'
        ];
    }

    public function getContributionData()
    {
        return new ContributionDTO([
            'name' => $this->input('name'),
            'receive_office_id' => $this->input('receive_office_id'),
            'office_id' => auth()->user()->office_id
        ]);
    }
}
