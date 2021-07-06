<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|string',
            'workspace' => 'required|email',
            'workspace_id' => 'int|nullable',
            'username' => 'required|string',
            'email' =>  'required|string',
            'role' =>  'string',
            'password' => 'required|string|min:8|max:25', 
        ];
    }

    public function getAttributes() {
        return $this->validated();
    }
}
