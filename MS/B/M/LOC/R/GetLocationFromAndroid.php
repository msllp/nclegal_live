<?php

namespace B\LOC\R;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class GetLocationFromAndroid extends FormRequest
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
       //      'Lat'=>"required",
     		// 'Lon'=>"required",
          
          
            ];

    }

    protected function formatErrors(Validator $validator)
{
    
    
    return [
    'msg' => $validator->errors()  ,
   
    ];

   
}

}