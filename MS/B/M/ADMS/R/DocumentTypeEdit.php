<?php
/**
 * Created by PhpStorm.
 * User: Mitul
 * Date: 10-12-2018
 * Time: 11:46 AM
 */

namespace B\ADMS\R ;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class DocumentTypeEdit extends FormRequest
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
            'UniqId'=>"required|".$rules,
            'NameOfDocuments'=>"required",



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

             'UniqId.required'=>"Document Type Code required Please fill Document Type Code.",
             'UniqId.exists'=>"Type of Document Code Not Found in our Database.",
             'NameOfDocuments.required'=>"Name of Type of Document required.",

        ];

    }

}