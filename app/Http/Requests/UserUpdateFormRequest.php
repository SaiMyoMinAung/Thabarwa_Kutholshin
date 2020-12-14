<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use App\Http\Requests\DTO\UserDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateFormRequest extends FormRequest
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
        $id = $this->user->id;
        return [
            'name' => 'required|max:255',
            'email' => "nullable|email|unique:users,email,$id|max:255",
            'phone' => "required|numeric|unique:users,phone,$id|max:99999999999",
            'city_id' => 'nullable|max:9999999',
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
            'city_id.required' => 'Please Select City.'
        ];
    }

    public function userData()
    {
        return new UserDTO([
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'phone' => $this->input('phone'),
            'city_id' => $this->input('city_id'),
            'password' => $this->addPassword(),
        ]);
    }

    public function addPassword()
    {
        $password = Str::random(8);
        $hash = Hash::make($password);
        if ($this->input('send_email')) {
            // send email
            return $hash;
        } else {
            return $this->user->password;
        }
    }
}
