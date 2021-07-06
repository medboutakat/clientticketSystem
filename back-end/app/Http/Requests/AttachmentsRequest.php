<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachmentsRequest extends FormRequest
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
            'check_bank_id'=>  'int|required',
            'file_name'=>  'required|string',
            'file'=>  'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'workspace_id'=> 'int|required',
        ]; 
    }

    public function getAttributes() {
        return $this->validated();
    }
}
