<?php
namespace B\LOC;


use \Illuminate\Http\Request;



use \MS\Core\Module\MasterModule\MasterBase;

class Base extends MasterBase{


///////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
//Basic Details of Model Table,Column & Connection///////////
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////

public static $controller="\B\LOC\Controller";
public static $model="\B\M\LOC\Model";


public static $routes=[
						[
						'name'=>'LOC.Data',
						'route'=>'/',
						'method'=>'index',
						'type'=>'get',
						],

						[
						'name'=>'LOC.index.Data',
						'route'=>'/data',
						'method'=>'indexData',
						'type'=>'get',
						],



						[
						'name'=>'LOC.Agent.View',
						'route'=>'/agent/view',
						'method'=>'agentViewAll',
						'type'=>'get',
						],


						[
						'name'=>'LOC.Location.Location.Android',
						'route'=>'/agent/location',
						'method'=>'postLocationFromandroid',
						'type'=>'get',
						],
						// [
						// 'name'=>'LOC.Location.Location.Json',
						// 'route'=>'/agent/location/json',
						// 'method'=>'postLocationJson',
						// 'type'=>'get',
						// ],


						[
						'name'=>'LOC.Location.Location.Json',
						'route'=>'/agent/location/json',
						'method'=>'getAgentNLocation',
						'type'=>'get',
						],



						[

						'name'=>'LOC.Location.Search.Trip',
						'route'=>'/agent/search/trip',
						'method'=>'searchTrips',
						'type'=>'get',

						],

						[

						'name'=>'LOC.Location.Search.Trip',
						'route'=>'/agent/search/trip',
						'method'=>'searchTripsPost',
						'type'=>'post',

						],


						[

						'name'=>'LOC.Location.Search.Trip.Data',
						'route'=>'/agent/search/trip/data',
						'method'=>'searchTripData',
						'type'=>'get',

						],


						


						[

						'name'=>'LOC.Location.TripBy.UniqId',
						'route'=>'/agent/trip/{UniqId}',
						'method'=>'getTrip',
						'type'=>'get',

						],


						[

						'name'=>'LOC.Location.TripBy.UniqId.Json',
						'route'=>'/agent/trip/{UniqId}/json',
						'method'=>'getTripJson',
						'type'=>'get',

						],
					];

public static $tableNo="0";



public static $connection ="MSDBC";

public static $allOnSameconnection=false;

public static $table="LOC";





////////////////////////////////////////////////////////////////////////
// Sub Module Start
////////////////////////////////////////////////////////////////////////
public static $table1="LOCmaster";

public static $connection1 ="LOC_Data";

public static $tableStatus1=false;

public static $field1=[
['name'=>'UniqId','type'=>'string','input'=>'auto','value'=>'genUniqID','default'=>'genUniqID',],

['name'=>'Lat','type'=>'string','input'=>'text'],
['name'=>'Lon','type'=>'string','input'=>'text'],
['name'=>'UserCode','type'=>'string','input'=>'text'],
['name'=>'AgencyCode','type'=>'string','input'=>'text'],
['name'=>'TaskCode','type'=>'string','input'=>'text'],
['name'=>'Status','type'=>'boolean','input'=>'radio','value'=>'status','default'=>'status'],

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