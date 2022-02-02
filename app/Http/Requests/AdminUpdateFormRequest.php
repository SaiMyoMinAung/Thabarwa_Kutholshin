<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use App\Http\Requests\DTO\AdminDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class AdminUpdateFormRequest extends FormRequest
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
        $id = $this->admin->id;

        return [
            'name' => 'required|max:255',
            'email' => "required|email|unique:admins,email,$id|max:255",
            'phone' => "required|numeric|unique:admins,phone,$id|max:99999999999",
            'office_id' => "required|numeric",
            'reset_password' => 'nullable'
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
            'office_id.required' => 'Please Select Office.',
        ];
    }

    public function adminData()
    {
        return new AdminDTO([
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'phone' => $this->input('phone'),
            'password' => $this->resetPassword() ? $this->addPassword() : $this->admin->password,
            'office_id' => $this->input('office_id'),
        ]);
    }

    public function resetPassword()
    {
        return $this->input('reset_password') != null && $this->input('reset_password') == "1";
    }

    public function addPassword()
    {
        $password = Str::random(8);
        $hash = Hash::make($password);

        $this->password = $password;

        return $hash;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
