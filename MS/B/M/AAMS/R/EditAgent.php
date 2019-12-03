<?php

namespace B\AAMS\R;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class EditAgent extends FormRequest
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


            $id=3;
            $agencCode=session('user.userData.UniqId');
            $table=\B\AAMS\Base::getTable($id). $agencCode;
            $conection=\B\AAMS\Base::getConnection($id);

            \MS\Core\Helper\Comman::DB_flush();

                       // dd($table);
            //Unique Agenet Code 
            $key='AgentCode';
            $rules['AgentCode']="exists:".$conection.".".$table.",".$key;


            //Unique Username
           // \MS\Core\Helper\Comman::DB_flush();
            //$rules['AgentUsername']="unique:".$conection.".".$table.",".$key;


         return [
            'AgentCode'=>"required|". $rules['AgentCode'],
            'AgentName'=>"required",
            'AgentContactNo'=>"required",
         //   'AgentEmail'=>"required",
            'AgentUsername'=>"required|",//.$rules['AgentUsername'],
         //   'AgentPassword'=>"required",
            //'AgentPasswordConfirm'=>"required|same:AgentPassword"
     
          
          
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

         'AgentCode.required'=>"Agency Code required Please fill Agent code.",
         'AgentName.required'=>"Agency Code required Please fill Agent Name.",
         'AgentContactNo.required'=>"Agency Code required Please fill Agent Contact No.",
         'AgentUsername.required'=>"Agency Code required Please fill Agent's Username.",
         'AgentPassword.required'=>"Agency Code required Please fill Password.",
       //  'AgentPasswordConfirm.required'=>"Agency Code required Please fill Confirm Password",
      //   'AgentPasswordConfirm.same'=>"The Password and Confirm Password must match.",

        // 'HireAgencyCode.exists'=>"Agency Code Not valid or not Found Master Agency Database.",
        // 'NameOperator.required'=>"Name of Operator is required Please fill Name of Operator.",
        // 'NameOwner.required'=>"Name of Owner is required Please fill Name of Owner.",

    ];
}

}