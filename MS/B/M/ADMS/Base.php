<?php
namespace B\ADMS;


use \Illuminate\Http\Request;



use \MS\Core\Module\MasterModule\MasterBase;

class Base extends MasterBase{


///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//Basic Details of Model Table,Column & Connection///////////
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

public static $controller="\B\ADMS\Controller";
public static $model="\B\ADMS\Model";


public static $routes=[
						[
						'name'=>'ADMS.Data',
						'route'=>'/',
						'method'=>'index',
						'type'=>'get',
						],

						[
						'name'=>'ADMS.index.Data',
						'route'=>'/data',
						'method'=>'indexData',
						'type'=>'get',
						],



						[
						'name'=>'ADMS.TypeOfDocument.ViewAll',
						'route'=>'/typeOfDocuments',
						'method'=>'viewAllTypeOfDocuments',
						'type'=>'get',
						],

						[
						'name'=>'ADMS.TypeOfDocument.Edit.Id',
						'route'=>'/typeOfDocuments/edit/{UniqId}',
						'method'=>'editDocumentType',
						'type'=>'get',
						],

                        [
                            'name'=>'ADMS.TypeOfDocument.Edit.Id.Post',
                            'route'=>'/typeOfDocuments/edit/{UniqId}',
                            'method'=>'editDocumentTypePost',
                            'type'=>'post',
                        ],

                        [
                            'name'=>'ADMS.TypeOfDocument.Add',
                            'route'=>'/typeOfDocuments/add',
                            'method'=>'addDocumentType',
                            'type'=>'get',
                        ],

                    [
                        'name'=>'ADMS.TypeOfDocument.Add.Post',
                        'route'=>'/typeOfDocuments/add',
                        'method'=>'addDocumentTypePost',
                        'type'=>'post',
                    ],

                    [
                        'name'=>'ADMS.Agent.Bill.View.All',
                        'route'=>'/agent/bills/all',
                        'method'=>'getAllAgentsBills',
                        'type'=>'get',
                    ],

                [
                    'name'=>'ADMS.Agent.Bill.Search.Data',
                    'route'=>'/agent/bills/search/data',
                    'method'=>'searchAgentBillData',
                    'type'=>'get',
                ],


                [
                    'name'=>'ADMS.Agent.Bill.Search',
                    'route'=>'/agent/bills/search',
                    'method'=>'searchAgentBill',
                    'type'=>'post',
                ],


                [
                    'name'=>'ADMS.Agent.Bill.Search.2',
                    'route'=>'/agent/bills/search/2',
                    'method'=>'searchAgentBill_2',
                    'type'=>'post',
                ],


            [
                'name'=>'ADMS.Get.Upload.File',
                'route'=>'/CDN/document/{LedgerId}/{fileId}',
                'method'=>'getDocument',
                'type'=>'get',

            ],









						

					];

public static $tableNo="0";



public static $connection ="MSDBC";

public static $allOnSameconnection=false;



////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table="ADMS";

public static $field=[
['name'=>'UniqId','type'=>'string','input'=>'auto','value'=>'genUniqID','default'=>'genUniqID',],
['name'=>'Status','type'=>'boolean','input'=>'radio','value'=>'status','default'=>'status'],

];



////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table1="ADMS_Agent_"; //ADMS_Agent_{AgentCode}_{TaskCode}

public static $connection1 ="ADMS_Data";

public static $tableStatus1=false;

public static $field1=[
['name'=>'UniqId','type'=>'string','input'=>'auto','callback'=>'genUniqID',],

['name'=>'TypeOfDocument','type'=>'string',],
['name'=>'NameOfDocument','type'=>'string',],
['name'=>'AmountOfDocument','type'=>'string',],
['name'=>'Path','type'=>'string',],
['name'=>'InvoiceIncludeCode','type'=>'string',],
['name'=>'CurrentStatus','type'=>'string',],
['name'=>'Status','type'=>'boolean','input'=>'radio','value'=>'status','default'=>'status'],

];



////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table2="ADMS_Document_Type";

public static $connection2 ="ADMS_Master";

public static $tableStatus2=false;

public static $field2=[

['name'=>'UniqId','type'=>'string','input'=>'auto','callback'=>'genUniqID',],
['name'=>'NameOfDocuments','type'=>'string','input'=>'option','callback'=>'getTypeofDocuments',],

];



////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table3="ADMS_Document_Type";

public static $connection3 ="ADMS_Master";

public static $tableStatus3=false;

public static $field3=[

['name'=>'UniqId','type'=>'string','input'=>'auto','callback'=>'genUniqID',],
['name'=>'NameOfDocuments','type'=>'string','input'=>'text','data'=>['required'=>'required']],

];



////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////






////////////////////////////////////
/////////////////////////////////////
//MODEL CALLBACK FUNCTIONS///////////
///////////////////////////////////
/////////////////////////////////




public static function status(){
	return [
	'Hide','Publish'
	];
}



public static function getTypeofDocuments(){
  \MS\Core\Helper\Comman::DB_flush();
  $m=new \B\ADMS\Model (2);
  return $m->MS_all()->pluck('NameOfDocuments','UniqId')->toArray();

}





}