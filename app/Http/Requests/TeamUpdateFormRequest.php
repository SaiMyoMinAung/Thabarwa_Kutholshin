<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\TeamDTO;
use Illuminate\Foundation\Http\FormRequest;

class TeamUpdateFormRequest extends FormRequest
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
        $id = $this->team->id;

        return [
            'name' => 'required|max:255',
            'email' => "nullable|email|unique:volunteers,email,$id|max:255",
            'phone' => "required|numeric|unique:volunteers,phone,$id|max:99999999999",
            'note' => "nullable|string|max:1000",
            'center_id' => 'required|max:9999999',
            'is_available' => 'nullable|numeric|max:1'
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
            'is_available' => $this->input('is_available') ?? 0
        ]);
    }
}
