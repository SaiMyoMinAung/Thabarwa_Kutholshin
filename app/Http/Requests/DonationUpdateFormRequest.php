<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DTO\DonatedItemUpdateDTO;

class DonationUpdateFormRequest extends FormRequest
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
            'qty' => 'required|numeric|max:999999',
            'estimate_cost' => 'required|numeric|max:9999999999',
            'donor_name' => 'required|max:255',
            'phone' => "required|numeric|max:99999999999",
            'pickedup_address' => 'required|max:255',
            'state_region_id' => 'nullable|max:9999999',
            'pickedup_at' => 'required|date',
            'image' => 'nullable|array|max:3',
            'image.*' => 'nullable|mimes:jpeg,png,jpg|max:10240',
            'remark' => 'nullable|max:255',
            'country_id' => 'nullable',
            'city_id' => 'nullable',
            'state_region_id' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'about_item.required' => 'Please Fill About Item.',
            'about_item.max' => 'About Item is Too Long!',
            'qty.required' => 'Please Fill Qty.',
            'qty.max' => 'Qty is Too Much!',
            'estimate_cost.required' => 'Please Fill Estimate Cost.',
            'estimate_cost.max' => 'Estimate Cost is Too Much!',
            'donor_name.required' => 'Please Fill Name.',
            'donor_name.max' => 'Name is Too Long!',
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
            'remark.max' => 'Remark Is Too Long!',
        ];
    }

    public function donatedItemData()
    {
        return new DonatedItemUpdateDTO([
            'about_item' => $this->input('about_item'),
            'qty' => $this->input('qty'),
            'estimate_cost' => $this->input('estimate_cost'),
            'donor_name' => $this->input('donor_name'),
            'phone' => $this->input('phone'),
            'pickedup_info' => $this->input('pickedup_address'),
            'pickedup_at' => $this->input('pickedup_at'),
            'remark' => $this->input('remark'),
            'country_id' => $this->input('country_id'),
            'city_id' => $this->input('city_id'),
            'state_region_id' => $this->input('state_region_id'),
        ]);
    }

    public function hasIsConfirmed()
    {
        if ($this->input('is_confirmed')) {
            return true;
        } else {
            return false;
        };
    }

    public function hasIsCancelled()
    {
        if ($this->input('is_cancelled')) {
            return true;
        } else {
            return false;
        };
    }
}
