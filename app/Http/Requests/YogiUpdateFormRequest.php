<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use App\Http\Requests\DTO\YogiDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class YogiUpdateFormRequest extends FormRequest
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
        $id = $this->yogi->id;

        return [
            'name' => "required|max:255|unique:yogis,name,$id",
            'phone' => "nullable|string|unique:yogis,phone,$id",
            'ward_id' => 'required|max:9999999'
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
            'ward_id.required' => 'Please Select Center.'
        ];
    }

    public function yogiData()
    {
        return new YogiDTO([
            'name' => $this->input('name'),
            'phone' => $this->input('phone'),
            'ward_id' => $this->input('ward_id'),
            'password' => $this->addPassword()
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
            return $this->yogi->password;
        }
    }
}
