<?php
namespace B\ANMS;


use \Illuminate\Http\Request;



use \MS\Core\Module\MasterModule\MasterBase;

class Base extends MasterBase{


///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//Basic Details of Model Table,Column & Connection///////////
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

public static $controller="\B\ANMS\Controller";
public static $model="\B\ANMS\Model";


public static $routes=[
						[
						'name'=>'ANMS.Data',
						'route'=>'/',
						'method'=>'index',
						'type'=>'get',
						],

						[
						'name'=>'ANMS.index.Data',
						'route'=>'/data',
						'method'=>'indexData',
						'type'=>'get',
						],

						[
						'name'=>'ANMS.Notification.By.User',
						'route'=>'/check/{UserId}/{NotificationCount?}',
						'method'=>'checkNotification',
						'type'=>'get',
						],


						[
						'name'=>'ANMS.Notification.By.Id',
						'route'=>'/view/{UserId}',
						'method'=>'viewById',
						'type'=>'get',
						],
					];

public static $tableNo="0";



public static $connection ="MSDBC";

public static $allOnSameconnection=false;



////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table1="ANMS_Agency_";

public static $connection1 ="ANMS_Data";

public static $tableStatus1=false;

public static $field1=[
['name'=>'UniqId','type'=>'string','input'=>'auto','value'=>'genUniqID','default'=>'genUniqID',],
['name'=>'TextOfNotification','type'=>'string',],
['name'=>'TypeOfNotification','type'=>'string',],
['name'=>'Read','type'=>'boolean',],
['name'=>'NotificationLink','type'=>'string',],
['name'=>'TargetLink','type'=>'string',],

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