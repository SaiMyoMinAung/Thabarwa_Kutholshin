<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DTO\DonationRecordDTO;
use App\Status\TypeOfMoney;

class DonationRecordUpdateRequest extends FormRequest
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
        $id = $this->donation_record->id;

        return [
            'date_of_donation' => 'required|date|before_or_equal:' . date('Y-m-d'),
            'sr_no' => "required|string|unique:donation_records,sr_no,$id|max:50",
            'certificate_no' => "required|string|unique:donation_records,certificate_no,$id|max:50",
            'center_id' => 'required|numeric|max:999999',
            'kind_of_donation_id' => 'required|numeric|max:999999',
            'main_donor_name' => 'required|string|max:255',
            'donation_cash' => 'required|numeric|max:99999999999',
            'type_of_money' => 'required|string',
            'donor' => 'required|string|max:800',
            'donation_material' => 'required|string|max:800',
            'estimate_cost' => 'required|numeric|max:99999999999'
        ];
    }

    public function donationRecordData()
    {
        $type = TypeOfMoney::advanceSearch($this->input('type_of_money'));
        
        return new DonationRecordDTO([
            'date_of_donation' => $this->input('date_of_donation'),
            'sr_no' => $this->input('sr_no'),
            'certificate_no' => $this->input('certificate_no'),
            'center_id' => $this->input('center_id'),
            'kind_of_donation_id' => $this->input('kind_of_donation_id'),
            'main_donor_name' => $this->input('main_donor_name'),
            'donation_cash' => $this->input('donation_cash'),
            'type_of_money' => $type["code"],
            'donor' => $this->input('donor'),
            'donation_material' => $this->input('donation_material'),
            'estimate_cost' => $this->input('estimate_cost'),
            'record_by' => auth()->user()->id
        ]);
    }
}
