<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\UserDTO;
use App\Http\Requests\DTO\DonatedItemDTO;
use App\Rules\Recaptcha;
use Illuminate\Foundation\Http\FormRequest;

class DonationStoreFormRequest extends FormRequest
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
            'about_item' => 'required|max:255',
            'name' => 'required|max:255',
            'phone' => 'required|numeric|max:99999999999',
            'pickedup_address' => 'required|max:255',
            'pickedup_at' => 'required|date|after_or_equal:' . date('Y-m-d'),
            'image' => 'nullable|array|max:3',
            'image.*' => 'nullable|mimes:jpeg,png,jpg|max:1024',
            'email' => 'nullable|email|max:255',
            'remark' => 'nullable|max:255',
            'recaptcha' => new Recaptcha,
        ];
    }

    public function messages()
    {
        return [
            'about_item.required' => 'Please Fill About Item.',
            'about_item.max' => 'About Item is Too Long!',
            'name.required' => 'Please Fill Name.',
            'name.max' => 'Name is Too Long!',
            'phone.required' => 'Please Fill Phone.',
            'phone.numeric' => 'Phone Must Be Number Only.',
            'phone.max' => 'Phone is Too Long!',
            'pickedup_address.required' => 'Please Fill Picked Up Address',
            'pickedup_address.max' => 'Picked Up Address is Too Long!',
            'pickedup_at.required' => 'Please Fill Picked Up Date.',
            'pickedup_at.date' => 'Picked Up Date Must Be Date.',
            'pickedup_at.after_or_equal' => 'Picked Up Date is Behind Today.',
            'image.max' => 'Only Less Than 3 Photos Limited.',
            'image.mimes' => 'Accept Photo Format is jpeg, png, jpg.',
            'image.*.max' => 'Photo Must Be Less Than 1MB.',
            'email.email' => 'Email Must Be Valid Email.',
            'email.max' => 'Email Is Too Long!',
            'remark.max' => 'Remark Is Too Long!',
        ];
    }

    public function userData()
    {
        return new UserDTO([
            'name' => $this->input('name'),
            'phone' => $this->input('phone'),
            'email' => $this->input('email'),
            'password' => bcrypt(rand(8, 9)),
        ]);
    }

    public function donatedItemData($donor_id)
    {
        return new DonatedItemDTO([
            'about_item' => $this->input('about_item'),
            'pickedup_info' => $this->input('pickedup_address'),
            'pickedup_at' => $this->input('pickedup_at'),
            'remark' => $this->input('remark'),
            'donor_id' => $donor_id
        ]);
    }
}
