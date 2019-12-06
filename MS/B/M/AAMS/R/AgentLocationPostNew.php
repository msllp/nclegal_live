<?php

namespace B\AAMS\R;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AgentLocationPostNew extends FormRequest
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


            $id=0;
            $table=\B\AMS\Base::getTable($id);
            $conection=\B\AMS\Base::getConnection($id);

            \MS\Core\Helper\Comman::DB_flush();

                       // dd($table);
            //Unique Agenet Code 
            $key='UniqId';
            $rules['AgencyCode']="exists:".$conection.".".$table.",".$key;

  
          //  dd($this);
           
//https://nc.ms/agency/AAMS/agents/Panel/agent/location?lat=37.39999833333333&lon=-122.2&AgencyCode=711&AgentCode=711_239&ApiToken=balbecjdfeefjggjgkgljae
         return [
            'AgencyCode'=>"required|". $rules['AgencyCode'],
            'AgentCode'=>"required",
            'lat'=>"required",
            'lon'=>"required",
            'ApiToken'=>"required",
           
          
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

         // 'AgencyCode.required'=>"Agency required Please Select Agency.",
         // 'UserName.required'=>"Username required Please fill Username.",
         // 'Password.required'=>"Password Code required Please fill Password.",
        

        // 'HireAgencyCode.exists'=>"Agency Code Not valid or not Found Master Agency Database.",
        // 'NameOperator.required'=>"Name of Operator is required Please fill Name of Operator.",
        // 'NameOwner.required'=>"Name of Owner is required Please fill Name of Owner.",

    ];
}

}