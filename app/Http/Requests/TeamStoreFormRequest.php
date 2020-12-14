<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\TeamDTO;
use Illuminate\Foundation\Http\FormRequest;

class TeamStoreFormRequest extends FormRequest
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
            'email' => "nullable|email|unique:teams|max:255",
            'phone' => "required|numeric|unique:teams|max:99999999999",
            'note' => "nullable|string|max:1000",
            'center_id' => 'required|max:9999999',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Fill Name.',
            'name.max' => 'Name is Too Long!',
            'phone.required' => 'Please Fill Phone.',
            'phone.numeric' => 'Phone Must Be Number Only.',
            'phone.max' => 'Phone is Too Long!',
            'email.email' => 'Email Must Be Valid Email.',
            'email.max' => 'Email Is Too Long!',
            'center_id.required' => 'Please Select Center.'
        ];
    }

    public function teamData()
    {
        return new TeamDTO([
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'phone' => $this->input('phone'),
            'center_id' => $this->input('center_id'),
            'note' => $this->input('note'),
            'is_available' => 1,
        ]);
    }
}
