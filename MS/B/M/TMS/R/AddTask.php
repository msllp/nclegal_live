<?php

namespace B\TMS\R;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AddTask extends FormRequest
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

        \MS\Core\Helper\Comman::DB_flush();
            $id=0;
            $conection=\B\AMS\Base::getConnection($id);
            $table=\B\AMS\Base::getTable($id);
            $key='UniqId';
            $rules="exists:".$conection.".".$table.",".$key;
//dd($rules);
\MS\Core\Helper\Comman::DB_flush();
             $id=0;
            $conection=\B\TMS\Base::getConnection($id);
            $table=\B\TMS\Base::getTable($id);
            $key='UniqId';
            $rules1="unique:".$conection.".".$table.",".$key;


            
         return [
            'UniqId'=>"required|".$rules1,
            'HireAgencyCode'=>"required|".$rules,
            'NameOperator'=>"required",
            'NameOwner'=>"required",
            'NameAreaPiracyCity'=>"required",
            'NameAreaPiracyDistrict'=>"required",
            'NameAreaPiracyState'=>"required",
            'NameAreaPiracyPincode'=>"required",
            'IllegalTypeBroadcasting'=>"required",
            'StatusOperator'=>"required",
            'NameOfNetwork'=>"required",
            'NameOperatorAddress1'=>"required",
            'NameOperatorCity'=>"required",
            'NameOperatorDistrict'=>"required",
            'NameOperatorState'=>"required",
            'NameOperatorPincode'=>"required",
            'Status'=>"required",

          
          
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

        'HireAgencyCode.required'=>"Agency Code required Please fill agency code.",
        'HireAgencyCode.exists'=>"Agency Code Not valid or not Found Master Agency Database.",
        'NameOperator.required'=>"Name of Operator is required Please fill Name of Operator.",
        'NameOwner.required'=>"Name of Owner is required Please fill Name of Owner.",
      //  'AreaPiracy.required'=>"Area of Piracy is required Please fill Area of Priacy.",
        
        'IllegalTypeBroadcasting.required'=>"Illegal Type of Broacasting is required Please fill Illegal Broacasting.",

        'StatusOperator.required'=>"Status of Operator is required Please fill Status of Operator.",
        'NameOfNetwork.required'=>"Name of LCO/MCO is required Please fill LCO/MCO.",
        'NameOperatorAddress1'=>"Address of Operator is required Please fill Address of Operator.",
        'NameOperatorCity.required'=>"City of Operator is required Please fill City located Operator's Headqurter.",
        'NameOperatorDistrict.required'=>"District of Operator is required Please fill District of Operator.",
        'NameOperatorState.required'=>"State of Operator is required Please fill State of Operator.",
        'NameOperatorPincode.required'=>"Pincode of Operator is required Please fill Pincode of Operator.",

    ];
}

}