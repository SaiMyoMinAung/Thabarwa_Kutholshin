<?php

namespace App\Http\Requests;

use App\Http\Requests\DTO\AssignStoreKeeperDTO;
use Illuminate\Foundation\Http\FormRequest;

class AssignStoreKeeperStoreRequest extends FormRequest
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
            'store_keeper_volunteer_id' => 'required|numeric|max:999999999',
            'store_id' => 'required|numeric|max:999999999',
            'box_id' => 'required|numeric|max:999999999',
        ];
    }

    public function assignStoreKeeperData()
    {
        return new AssignStoreKeeperDTO([
            'store_keeper_volunteer_id' => $this->input('store_keeper_volunteer_id'),
            'store_id' => $this->input('store_id'),
            'box_id' => $this->input('box_id')
        ]);
    }
}
