<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\ContributionDTO;
use App\Rules\ReceiveOfficeCanChange;
use Illuminate\Foundation\Http\FormRequest;

class ContributionUpdateFormRequest extends FormRequest
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
            'title' => 'required|max:255',
            'note' => 'required|string|max:1000',
            'volunteer_id' => "required|numeric",
            'receive_office_id' => ['required', new ReceiveOfficeCanChange($this->contribution)],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please Fill Title.',
            'title.max' => 'Title is Too Long!',
            'note.required' => 'Please Fill Note.',
            'volunteer_id.required' => 'Please Select Volunteer.'
        ];
    }

    public function getContributionData()
    {
        return new ContributionDTO([
            'title' => $this->input('title'),
            'note' => $this->input('note'),
            'volunteer_id' => $this->input('volunteer_id'),
            'office_id' => auth()->user()->office->id,
            'receive_office_id' => $this->input('receive_office_id'),
        ]);
    }
}
