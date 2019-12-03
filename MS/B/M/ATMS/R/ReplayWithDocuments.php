<?php

namespace B\ATMS\R;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ReplayWithDocuments extends FormRequest
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
          //  'UniqId'=>"required",
             'replaceFiles' =>'array|required',
            // 'date.*',
            // 'documentNo.*',
            // 'documentAmount.*',
            // 'SelectedFilesQuery.*'
         // 'replaceFiles.*.file'=>'required',
           //'TypeOfDocuments.*' =>'required',
            // 'DateOfDocument.*'  =>'required',
            // 'replaceFiles'    =>'required',
            // 'NoOfDocument.*'    =>"nullable|required_if:TypeOfDocuments.*,777|required_if:TypeOfDocuments.*,888",
            // 'AmountOfDocument.*'=>"nullable|required_if:TypeOfDocuments.*,777|required_if:TypeOfDocuments.*,888|numeric"
     
          
          
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

   // dd($this);
    return [

        'replaceFiles.*.file.required'=>'File Required.'
        
    ];
}


}