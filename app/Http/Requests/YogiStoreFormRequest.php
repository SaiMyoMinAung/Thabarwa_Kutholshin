<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use App\Http\Requests\DTO\YogiDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class YogiStoreFormRequest extends FormRequest
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
            'name' => 'required|string|unique:yogis|max:255',
            'phone' => "nullable|string|unique:yogis|max:255",
            'ward_id' => 'required|max:9999999',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Fill Name.',
            'name.max' => 'Name is Too Long!',
            'phone.required' => 'Please Fill Phone.',
            'phone.max' => 'Phone is Too Long!',
            'ward_id.required' => 'Please Select Ward.'
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
        }
        return $hash;
    }
}
