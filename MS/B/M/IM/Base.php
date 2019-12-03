<?php
namespace B\IM;


use \Illuminate\Http\Request;



use \MS\Core\Module\MasterModule\MasterBase;

class Base extends MasterBase{


///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//Basic Details of Model Table,Column & Connection///////////
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

public static $controller="\B\IM\Controller";
public static $model="\B\IM\Model";

public static $routes=[
						[
						'name'=>'IM.Data',
						'route'=>'/',
						'method'=>'index',
						'type'=>'get',
						],

						[
						'name'=>'IM.index.Data',
						'route'=>'/data',
						'method'=>'indexData',
						'type'=>'get',
						],

						[
						'name'=>'IM.InvoiceDetails.By.Id',
						'route'=>'/hook/AMS/get/invoice/{AgencyCode}/{InvoiceCode}',
						'method'=>'viewInvoiceDetails',
						'type'=>'get',
						],


						[
						'name'=>'IM.InvoiceDetails.By.Id.DataLink',
						'route'=>'/hook/AMS/get/invoice/{data}',
						'method'=>'viewInvoiceDetailsDataLink',
						'type'=>'get',
						],


						[
						'name'=>'IM.Invoice.Add.Payment.By.Id',
						'route'=>'/hook/TMS/invoice/add/payments/{AgencyCode}/{InvoiceCode}',
						'method'=>'addInvoicePayments',
						'type'=>'get',
						],


						[
						'name'=>'IM.Invoice.Add.Payment.By.Id.Post',
						'route'=>'/hook/TMS/invoice/add/payments/{AgencyCode}/{InvoiceCode}/post',
						'method'=>'addInvoicePaymentsPost',
						'type'=>'post',
						],


						[

						'name'=>'IM.Invoice.Get.All.Ajax',
						'route'=>'/hook/TMS/invoice/get/agency/{AgencyCode}',
						'method'=>'getInvoiceByAgencyAjax',
						'type'=>'get',
						],


					];

public static $tableNo="0";

public static $table="Invoices";//.TaskId;

public static $field=[];

public static $connection ="MSDBC";

public static $allOnSameconnection=false;



////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table1="IM_Invoice_";//.TaskId;

public static $connection1 ="IM_Data";

public static $tableStatus1=false;

public static $field1=[
['name'=>'UniqId','type'=>'string','input'=>'auto','value'=>'genUniqID','default'=>'genUniqID',],
['name'=>'StepId','type'=>'string'],
['name'=>'DocumentId','type'=>'string'],
['name'=>'TypeOfDocument','type'=>'string'],
['name'=>'NameofDocument','type'=>'string'],
['name'=>'PathofDocument','type'=>'string'],
['name'=>'Amount','type'=>'string'],
['name'=>'Tax','type'=>'string'],
['name'=>'StarAprNo','type'=>'string'],
['name'=>'MasterInvoiceNo','type'=>'string'],
['name'=>'HasStarAprNo','type'=>'string'],
['name'=>'HasMasterInvoiceNo','type'=>'string'],
['name'=>'CurrentStatus','type'=>'string'],
];



////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table2="IM_TypeOfStatus";//.TaskId;

public static $connection2 ="IM_Master";

public static $tableStatus2=false;

public static $field2=[

['name'=>'UniqId','type'=>'string','input'=>'auto','value'=>'genUniqID','default'=>'genUniqID',],
['name'=>'NameOfStatus','type'=>'string'],

];




////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table3="IM_Agency_Ledger_"; //_Agency_Code //For Master Payment Ledger 

public static $connection3 ="IM_Data";

public static $tableStatus3=false;


public static $field3=[
['name'=>'UniqId','type'=>'string','input'=>'auto','value'=>'genUniqID','default'=>'genUniqID',],
['name'=>'MasterInvoiceId','vName'=>'Invoice ID','type'=>'string','input'=>'number','data'=>['input-size'=>'col-lg-3'] ,],
['name'=>'TaskId','vName'=>'Task ID','type'=>'string','input'=>'number','data'=>['input-size'=>'col-lg-3'] ,],

 ['name'=>'DateOfUpload','vName'=>'Invoice No. of LF','type'=>'string','input'=>'number','data'=>['input-size'=>'col-lg-3'] ,],

['name'=>'NotifyNo','vName'=>'Notification No.','type'=>'string','input'=>'text','data'=>['input-size'=>'col-lg-3'] ,],
['name'=>'DateOfPaymentToAgency','vName'=>'Date of Payment to Agency','type'=>'string','input'=>'date','data'=>['input-size'=>'col-lg-4'] ,],

['name'=>'Paid','vName'=>'Paid','type'=>'boolean','input'=>'text','data'=>['input-size'=>'col-lg-4'] ,],
['name'=>'PartiallyPaid','vName'=>'Paid Partially','type'=>'boolean','input'=>'text','data'=>['input-size'=>'col-lg-4'] ,],


['name'=>'Total','vName'=>'Total','type'=>'string','input'=>'number','data'=>['input-size'=>'col-lg-6'] ,],
['name'=>'TotalPaid','vName'=>'Total Amount Paid','type'=>'string','input'=>'number','data'=>['input-size'=>'col-lg-6'] ],

['name'=>'InvoiceIncluded','type'=>'string'],

['name'=>'PaymentStatus','type'=>'boolean' ], 


];



////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table4="IM_Agency_Invoice_"; //_AgencyCode_UniqId from table 3 //For Master Payment Ledger 

public static $connection4 ="IM_Data";

public static $tableStatus4=false;
public static $field4=[

['name'=>'UniqId','type'=>'string','input'=>'auto','value'=>'genUniqID','default'=>'genUniqID',],
['name'=>'StepId','type'=>'string'],
['name'=>'DocumentId','type'=>'string'],
['name'=>'TypeOfDocument','type'=>'string'],
['name'=>'NameofDocument','type'=>'string'],
['name'=>'PathofDocument','type'=>'string'],
['name'=>'Amount','type'=>'string'],
['name'=>'Tax','type'=>'string'],



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







}