<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\VolunteerDTO;
use Illuminate\Foundation\Http\FormRequest;

class VolunteerUpdateFormRequest extends FormRequest
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
        $id = $this->volunteer->id;

        return [
            'name' => 'required|max:255',
            'email' => "nullable|email|unique:volunteers,email,$id|max:255",
            'phone' => "required|numeric|unique:volunteers,phone,$id|max:99999999999",
            'office_id' => 'required|max:9999999',
            'volunteer_job_id' => 'required',
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
            'office_id.required' => 'Please Select Office.'
        ];
    }

    public function volunteerJobData()
    {
        return $this->input('volunteer_job_id');
    }

    public function volunteerData()
    {
        return new VolunteerDTO([
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'phone' => $this->input('phone'),
            'password' => $this->volunteer->password,
            'office_id' => $this->input('office_id'),
        ]);
    }
}
