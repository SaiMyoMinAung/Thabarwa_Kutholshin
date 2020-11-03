<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DTO\AssignRepairerDTO;

class AssignRepairerStoreRequest extends FormRequest
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
            'repaired_volunteer_id' => 'required|numeric|max:999999999',
        ];
    }

    public function assignRepairerData()
    {
        return new AssignRepairerDTO([
            'repaired_volunteer_id' => $this->input('repaired_volunteer_id')
        ]);
    }
}
