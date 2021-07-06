<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckStatesRequest extends FormRequest
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
            'check_state_id' => 'int|required' ,
            // 'bank_id'=> 'int',
            // 'payment_modes_id'=> 'int',
        ];
    }

    public function getAttributes() {
        return $this->validated();
    }
}
