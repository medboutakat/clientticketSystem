<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckBankFilterRequest extends FormRequest
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
            'from' => 'required|date',
            'to' => 'required|date', 
            'customer_id' => 'int|nullable' ,
            'nature_checks_id' => 'int|nullable',
            'payment_modes_id'=> 'int|nullable' ,
        ];
    }

    public function getAttributes() {
        return $this->validated();
    }
}
