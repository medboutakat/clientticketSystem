<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'display_name' => 'string|nullable',  
            'description' => 'string|nullable', 
            'image_url' => 'string|nullable',   
            'price' =>  'string|nullable',   
            'tags' => 'string|nullable', 
            'fileName' => 'mimes:jpeg,bmp,png|nullable', 
        ];
    }
 
    public function getAttributes() {
        return $this->validated();
    }
}
