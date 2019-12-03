<?php

namespace B\ADMS\R;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class Form extends FormRequest
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
            'UniqId'=>"required",
     
          
          
            ];

    }

    protected function formatErrors(Validator $validator)
{
    
    
    return [
    'msg' => $validator->errors()  ,
   
    ];

   
}

public function messages()
{
    return [

        // 'HireAgencyCode.required'=>"Agency Code required Please fill agency code.",
        // 'HireAgencyCode.exists'=>"Agency Code Not valid or not Found Master Agency Database.",
        // 'NameOperator.required'=>"Name of Operator is required Please fill Name of Operator.",
        // 'NameOwner.required'=>"Name of Owner is required Please fill Name of Owner.",
    ];

}


}