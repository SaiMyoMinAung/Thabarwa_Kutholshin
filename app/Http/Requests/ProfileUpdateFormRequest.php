<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\ProfileDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ProfileUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->admin->uuid != auth()->user()->uuid) {
            $error = ValidationException::withMessages([
                'profile_error' => ['Cannot Update Other Admin Profile'],
            ]);
            throw $error;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->admin->id;

        return [
            'name' => 'required|max:255',
            'email' => "required|email|unique:admins,email,$id|max:255",
            'phone' => "required|numeric|unique:admins,phone,$id|max:99999999999",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Fill Name.',
            'name.max' => 'User Name is Too Long!',
            'phone.required' => 'Please Fill Phone.',
            'phone.numeric' => 'Phone Must Be Number Only.',
            'phone.max' => 'Phone is Too Long!',
            'email.email' => 'Email Must Be Valid Email.',
            'email.max' => 'Email Is Too Long!',
        ];
    }

    public function profileData()
    {
        return new ProfileDTO([
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'phone' => $this->input('phone')
        ]);
    }
}
