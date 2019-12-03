<?php

namespace B\TMS\R;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AddInvoice extends FormRequest
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
            'MasterInvoiceNo'=>"required",
            'SelectedFiles' =>'required',
            'NotificationNo'=>'required'
          
          
            ];

    }



       public static function MS_rules()
    {
         return [
            'MasterInvoiceNo'=>"required",
            'SelectedFiles' =>'required',
            'NotificationNo'=>'required'
          
          
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
        'MasterInvoiceNo.required'=>'Master Invoice Number Required .Please Enter Valid Invoice Number.',
        'SelectedFiles.required'=>'Select atleast 1 Invoice.',
         'NotificationNo.required'=>'Notification Number Required .Please Enter Valid Notification Number.'
       
       ];

}



}