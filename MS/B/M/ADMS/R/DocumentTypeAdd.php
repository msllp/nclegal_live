<?php
/**
 * Created by PhpStorm.
 * User: Mitul
 * Date: 10-12-2018
 * Time: 12:49 PM
 */

namespace B\ADMS\R;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;


class DocumentTypeAdd extends FormRequest
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
        $rules="unique:".$conection.".".$table.",".$key;


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
            'UniqId.unique'=>"Type of Document Code Found in our Database.Please refresh page & try with New Uniq ID",
            'NameOfDocuments.required'=>"Name of Type of Document required.",

        ];

    }

}