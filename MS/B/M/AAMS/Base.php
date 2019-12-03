<?php
namespace B\AAMS;


use \Illuminate\Http\Request;



use \MS\Core\Module\MasterModule\MasterBase;

class Base extends MasterBase{


///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//Basic Details of Model Table,Column & Connection///////////
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

public static $controller="\B\AAMS\Controller";
public static $model="\B\AAMS\Model";


public static $routes=[
						[
						'name'=>'AAMS.Data',
						'route'=>'/',
						'method'=>'index',
						'type'=>'get',
						],

						[
						'name'=>'AAMS.index.Data',
						'route'=>'/data',
						'method'=>'indexData',
						'type'=>'get',
						],



						[
						'name'=>'AAMS.Agent.Add',
						'route'=>'/agent/add',
						'method'=>'agentAdd',
						'type'=>'get',
						],


						[
						'name'=>'AAMS.Agent.Add.Post',
						'route'=>'/agent/add',
						'method'=>'agentAddPost',
						'type'=>'post',
						],



						[
						'name'=>'AAMS.Agent.View',
						'route'=>'/agent/view',
						'method'=>'agentView',
						'type'=>'get',
						],


						[
						'name'=>'AAMS.Agent.View.Id',
						'route'=>'/agents/view/{UniqId}',
						'method'=>'agentsViewbyId',
						'type'=>'get',
						],



						[
						'name'=>'AAMS.Agent.Login',
						'route'=>'/agents/login',
						'method'=>'agentsLoginPage',
						'type'=>'get',
						],



						[
						'name'=>'AAMS.Agent.Logout',
						'route'=>'/agents/logout',
						'method'=>'agentsLogout',
						'type'=>'get',
						],


						[
						'name'=>'AAMS.Agent.Login.Post',
						'route'=>'/agents/login',
						'method'=>'agentLoginPost',
						'type'=>'post',
						],

						[
						'name'=>'AAMS.Agent.Panel',
						'route'=>'/agents/Panel',
						'method'=>'agentPanel',
						'type'=>'get',
						],


						[
						'name'=>'AAMS.Agent.Panel.Data',
						'route'=>'/agents/Panel/data',
						'method'=>'agentPanelData',
						'type'=>'get',
						],


						[
						'name'=>'AAMS.Agent.LoctionPost',
						'route'=>'/agents/location',
						'method'=>'agentLoctionPostMs',
						'type'=>'get',
						],


						[
						'name'=>'AAMS.Agent.TaskPost',
						'route'=>'/agents/task',
						'method'=>'agentTaskPost',
						'type'=>'post',
						],

						

						// [
						// 'name'=>'AAMS.Agent.Edit.Id',
						// 'route'=>'/agency/edit/{UniqId}',
						// 'method'=>'agencyEditbyId',
						// 'type'=>'get',
						// ],


						// [
						// 'name'=>'AAMS.Agent.Edit.Id.Post',
						// 'route'=>'/agency/edit',
						// 'method'=>'agencyEditbyIdPost',
						// 'type'=>'post',
						// ],

						[
						'name'=>'AAMS.Agent.Delete.Id',
						'route'=>'/agent/delete/{UniqId}',
						'method'=>'agentDeletebyId',
						'type'=>'get',
						],
						

						[
						'name'=>'AAMS.Agent.Upload.Form',
						'route'=>'/agent/upload/{agentCode}',
						'method'=>'agentUploadForm',
						'type'=>'get',
						],


						[
						'name'=>'AAMS.Agent.Upload.Post',
						'route'=>'/agent/upload/{agentCode}',
						'method'=>'agentUploadPost',
						'type'=>'post',
						],




						// [
						// 'name'=>'AAMS.Agent.Login',
						// 'route'=>'/hook/AgencyLogin',
						// 'method'=>'hookAgencyLoginPost',
						// 'type'=>'post',
						// ],


						// [
						// 'name'=>'AAMS.Agent.LoginAsAdmin.Id',
						// 'route'=>'/agency/login/as/{UniqId}',
						// 'method'=>'agencyLoginAsbyId',
						// 'type'=>'get',
						// ],


						// [
						// 'name'=>'AAMS.Agent.BackAsAdmin',
						// 'route'=>'/agency/login/back',
						// 'method'=>'backAgencyAsby',
						// 'type'=>'get',
						// ],

						[
						'name'=>'AAMS.Agent.edit',
						'route'=>'/agent/edit/{agentCode}',
						'method'=>'editAgentForm',
						'type'=>'get',
						],

						[
						'name'=>'AAMS.Agent.post',
						'route'=>'/agent/edit/',
						'method'=>'editAgentFormPost',
						'type'=>'post',
						],


					];

public static $tableNo="0";



//public static $connection ="MSDBC";

public static $allOnSameconnection=false;



////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table="AAMS_Agency_Agent_Master_";

public static $connection ="AAMS_Master";

public static $tableStatus=false;

public static $field=[
['name'=>'UniqId','type'=>'string','input'=>'auto','callback'=>'genUniqID','default'=>'genUniqID',],
['name'=>'AgentCode','type'=>'string','input'=>'text',],
['name'=>'AgentName','type'=>'string','input'=>'text',],
['name'=>'AgentContactNo','type'=>'string','input'=>'text',],
['name'=>'AgentEmail','type'=>'string','input'=>'text',],
['name'=>'AgentUsername','type'=>'string','input'=>'text',],
['name'=>'AgentPassword','type'=>'string','input'=>'text',],
['name'=>'AgentLastLAT','type'=>'string','input'=>'text',],
['name'=>'AgentLastLNG','type'=>'string','input'=>'text',],
['name'=>'AgentLoactionApiToken','type'=>'string','input'=>'text',],
];


////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table1="AAMS_Agency_Agent_Master_";

public static $connection1 ="AAMS_Master";

public static $tableStatus1=false;

public static $field1=[


['name'=>'AgentCode','vName'=>'Agent Code','type'=>'string','input'=>'auto','callback'=>'gentrateAgentCode', 'data'=>['input-size'=>'col-lg-1' ,] ],

//['name'=>'UniqId','vName'=>'Agent Unique Code','type'=>'string','input'=>'auto','callback'=>'genUniqID',],


['name'=>'AgentName','type'=>'string','input'=>'text','data'=>['input-size'=>'col-lg-8' ,'required'=>'required'] ],
['name'=>'AgentContactNo','type'=>'string','input'=>'text','data'=>['input-size'=>'col-lg-3' ,'required'=>'required'] ],
['name'=>'AgentEmail','type'=>'string','input'=>'email','data'=>['input-size'=>'col-lg-12' ] ],
['name'=>'AgentUsername','type'=>'string','input'=>'text','data'=>['input-size'=>'col-lg-4' ,'required'=>'required'] ],
['name'=>'AgentPassword','vName'=>'Password','type'=>'string','input'=>'password','data'=>['input-size'=>'col-lg-4' ,'required'=>'required'] ],
['name'=>'AgentPasswordConfirm','vName'=>'Confirn Password','type'=>'string','input'=>'password','data'=>['input-size'=>'col-lg-4' ,'required'=>'required'] ],



];


////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table2="AAMS_Agency_Agent_";

public static $connection2 ="AAMS_Master";

public static $tableStatus2=false;

public static $field2=[


['name'=>'AgentTripCode','type'=>'string',],
['name'=>'AgentTaskCode','type'=>'string',],


//['name'=>'UniqId','vName'=>'Agent Unique Code','type'=>'string','input'=>'auto','callback'=>'genUniqID',],



];


////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table3="AAMS_Agency_Agent_Master_";

public static $connection3 ="AAMS_Master";

public static $tableStatus3=false;

public static $field3=[
['name'=>'UniqId','type'=>'string','input'=>'auto','callback'=>'genUniqID','default'=>'genUniqID',],
['name'=>'AgentCode','type'=>'string','input'=>'text',],
['name'=>'AgentName','type'=>'string','input'=>'text',],
['name'=>'AgentContactNo','type'=>'string','input'=>'text',],
['name'=>'AgentEmail','type'=>'string','input'=>'text',],
['name'=>'AgentUsername','type'=>'string','input'=>'text',],
['name'=>'AgentPassword','type'=>'string','input'=>'text',],
['name'=>'AgentLastLAT','type'=>'string','input'=>'text',],
['name'=>'AgentLastLNG','type'=>'string','input'=>'text',],
['name'=>'AgentLoactionApiToken','type'=>'string','input'=>'text',],
['name'=>'AgentLastTask','type'=>'string','input'=>'text',],
['name'=>'AgentCurrentTask','type'=>'string','input'=>'text',],
];


////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////



	
////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table4="AAMS_Agency_Trip_Master_";

public static $connection4 ="AAMS_Master";

public static $tableStatus4=false;

public static $field4=[

['name'=>'UniqId','type'=>'string','input'=>'auto','callback'=>'genUniqID','default'=>'genUniqID',],
['name'=>'TaskCode','type'=>'string',],

['name'=>'TripCode','type'=>'string',],

['name'=>'AgentCode','type'=>'string',],


['name'=>'LastLat','type'=>'string',],

['name'=>'LastLNG','type'=>'string',],

['name'=>'MacAddress','type'=>'string',],

['name'=>'DeviceName','type'=>'string',],

['name'=>'LoginIP','type'=>'string',],


];


////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table5="AAMS_Agency_Agent_Trip_";

public static $connection5 ="AAMS_Data";

public static $tableStatus5=false;

public static $field5=[


['name'=>'UniqId','type'=>'string','input'=>'auto','callback'=>'genUniqID','default'=>'genUniqID',],
['name'=>'LAT','type'=>'string',],
['name'=>'LNG','type'=>'string',],




];


////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table6="AAMS";

public static $connection6 ="AAMS_Data";

public static $tableStatus6=false;

public static $field6=[
//['name'=>'UniqId','type'=>'string','input'=>'auto','callback'=>'genUniqID',],
['name'=>'TypeOfDocuments','type'=>'string','input'=>'option','callback'=>'getTypeofDocuments',],
//['name'=>'DateOfDocument','vName'=>'Date of Document','type'=>'boolean','input'=>'date' ,'data'=>['input-size'=>'col-lg-2'] ,'callback'=>'getCurrentDate'],
['name'=>'AmountOfDocument','vName'=>'Total Amount','type'=>'boolean','input'=>'number','data'=>['input-size'=>'col-lg-2','required'=>'require'] ,],
['name'=>'agencyDocument','vName'=>'Select File','type'=>'boolean','input'=>'file','data'=>['input-size'=>'col-lg-2','required'=>'require'] ,],


];



////////////////////////////////////////////////////////////////////////
// Sub Module End
////////////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table7="AAMS_Agency_Agent_Master_";

public static $connection7 ="AAMS_Master";

public static $tableStatus7=false;

public static $field7=[


['name'=>'AgentCode','vName'=>'Agent Code','type'=>'string','input'=>'auto','callback'=>'gentrateAgentCode', 'data'=>['input-size'=>'col-lg-3' ,] ],

//['name'=>'UniqId','vName'=>'Agent Unique Code','type'=>'string','input'=>'auto','callback'=>'genUniqID',],


['name'=>'AgentName','type'=>'string','input'=>'text','data'=>['input-size'=>'col-lg-9' ,'required'=>'required'] ],
['name'=>'AgentContactNo','type'=>'string','input'=>'text','data'=>['input-size'=>'col-lg-6' ,'required'=>'required'] ],
['name'=>'AgentEmail','type'=>'string','input'=>'email','data'=>['input-size'=>'col-lg-6' ] ],
['name'=>'AgentUsername','type'=>'string','input'=>'text','data'=>['input-size'=>'col-lg-6' ,'required'=>'required'] ],
['name'=>'AgentPassword','vName'=>'Password','type'=>'string','input'=>'password','data'=>['input-size'=>'col-lg-6' ,'required'=>'required'] ],



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

public static function gentrateAgentCode(){

	$userCode=session('user')['userData']['UniqId']."_".parent::genUniqID();

	return  $userCode;



}

public static function genrateTripCode($TaskCode,$AgentCode){

	return $TaskCode."_".$AgentCode."_".\MS\Core\Helper\Comman::getYr()."_".\MS\Core\Helper\Comman::getMon()."_".\MS\Core\Helper\Comman::getDay();

}

public static function getCurrentDate (){

	return \MS\Core\Helper\Comman::getYr()."-".\MS\Core\Helper\Comman::getMon()."-".\MS\Core\Helper\Comman::getDay();
}



public static function getTypeofDocuments(){
  \MS\Core\Helper\Comman::DB_flush();
  $m=new \B\ADMS\Model (2);
  return $m->MS_all()->pluck('NameOfDocuments','UniqId')->toArray();

}



}