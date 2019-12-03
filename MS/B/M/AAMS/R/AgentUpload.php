<?php
/**
 * Created by PhpStorm.
 * User: Mitul
 * Date: 10-12-2018
 * Time: 01:10 PM
 */

namespace B\AAMS\R;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class AgentUpload extends FormRequest
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

        $id=2;

        $conection=\B\ADMS\Base::getConnection($id);
        $table=\B\ADMS\Base::getTable($id);


        $key='UniqId';
        $rules="exists:".$conection.".".$table.",".$key;


        return [
          //  'UniqId'=>"required|".$rules,
            'TypeOfDocuments.0'=>"required|".$rules,
            'AmountOfDocument.0'=>"required",
            'agencyDocument.0'=>"required|file",



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

           // 'UniqId.required'=>"Document Type Code required Please fill Document Type Code.",
            'TypeOfDocuments.exists'=>"Select ValidType of Document.",
            'TypeOfDocuments.0.required'=>"Select ValidType of Document.",

            'AmountOfDocument.0.required'=>"Enter Valid Total Amount .",
            'agencyDocument.0.required'=>"Please select File to upload .",
        ];

    }

}