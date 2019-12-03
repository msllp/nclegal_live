<?php

namespace B\AAMS\F;


class SearchTrips{


	public static function  byTaskId  ($taskId){

				$TaskCode=$taskId;

				
				$m1=new \B\TMS\Model(7);
				//dd($m1->where('UniqId',$TaskCode."3")->get()->first() );
				$TaskData=$m1->where('UniqId',$TaskCode)->get()->first();
				if($TaskData != null){
					
					$AgencyCode=$TaskData->toArray()['HireAgencyCode'];
					
					$con=\B\AAMS\Base::getConnection(4);
					$table=\B\AAMS\Base::getTable(4,$AgencyCode);
					if(\B\AAMS\Model::checkTableinDB($con,$table))
					{
					$m2=new \B\AAMS\Model(4,$AgencyCode);


					//dd($m2->MS_all()->toArray());



					//\MS\Core\Helper\Comman::DB_flush();
					$tableId=4;

					$build=new \MS\Core\Helper\Builder ("B\AAMS");
					//$build->title("View  Trip");
				//	

					//$model=new \B\AAMS\Model($tableId,$AgencyCode);

					//dd($model);
					$model=$m2->where('TaskCode',$taskId)->paginate(500);
					//dd($m2);
					//dd($m2->where('TaskId',$taskId)->get());
//MS\Core\Helper\Comman::DB_flush();
	//	dd($model);

						$diplayArray=[

				//'UniqId'=>'Trip ID',

				'TripCode'=>'Trip Code',

				'AgentCode'=>'Name of Agent',

				'created_at'=>'Start Date',
				'updated_at'=>'Last Update'


						];

						$link=[

			// 'delete'=>[
			// 	'method'=>'TMS.Task.Delete.Id',
			// 	'key'=>'UniqId',

			// ],

			// 'edit'=>[
			// 	'method'=>'AMS.Agency.Edit.Id',
			// 	'key'=>'UniqId',

			// ],


			'view'=>[
				'method'=>'LOC.Location.TripBy.UniqId',
				'key'=>'TripCode',

			],

			// 'AllocationLater'=>[
			// 	'method'=>'TMS.Task.Gen.Allocation',
			// 	'key'=>'UniqId',
			// ],

		];



						$build->listData($model)->listView($diplayArray)
											// ->btn([
											// 	'action'=>"\\B\\TMS\\Controller@taskAdd",
											// 	'color'=>"btn-info",
											// 	'icon'=>"fa fa-plus",
											// 	'text'=>"Add Task"
											// ]



											// )
											// ->btn( 
											// [
											// 	'action'=>"\\B\\TMS\\Controller@taskViewByColumn",
											// 	'color'=>"btn-default",
											// 	'icon'=>"fa fa-eye",
											// 	'text'=>"Group By Agency",
											// 	'data'=>'HireAgencyCode'
											// ])
											// ->btn( 
											// [
											// 	'action'=>"\\B\\TMS\\Controller@taskViewByColumn",
											// 	'color'=>"btn-default",
											// 	'icon'=>"fa fa-eye",
											// 	'text'=>"Group By State",
											// 	'data'=>'NameOperatorState'
											// ])
											// ->btn( 
											// [
											// 	'action'=>"\\B\\TMS\\Controller@taskViewByColumn",
											// 	'color'=>"btn-default",
											// 	'icon'=>"fa fa-eye",
											// 	'text'=>"Group By Month",
											// 	'data'=>'created_at'
											// ])
											->addListAction($link)->listGetter(['AgentCode','created_at','updated_at']);	

						return $build->view(true,'list');




					}

				}


	}


	public static function viewTrip($UniqId){

		

		return view("LOC.V.Object.viewTripByAgentCode")->with('UniqId',$UniqId);
		//dd($m);


	}

	public static function viewTripJson($UniqId){

		$m=new \B\AAMS\Model(5,$UniqId);


		$array=$m->MS_all()->take(500)->sortBy('id');


		$UniqIdExp=explode('_', $UniqId);	
			$agencyCode=$UniqIdExp[0];
			$agentCode=implode('_', [ $UniqIdExp[1],$UniqIdExp[2]  ]);
			//dd($agentCode);



		foreach ($array as $key => $value) {
			//dd($array->toArray());


			$details=[
					// "<img src='". asset('images/detective.svg') ."' style='max-height:32px;margin-bottom:5px;'>",
					// 'Agent Name: '.$value1['AgentName']." (".$value1['AgentContactNo'].")",
					// "Agency : ".'<span class="ms-mod-btn text-info btn btn-sm" ms-live-link="'. route("AMS.Agency.View.Id",\MS\Core\Helper\Comman::en4url($value['UniqId'])).'" >'.$agencyName."</span>",
					// //'Current Task Id : <span class="ms-mod-btn text-info btn btn-sm" ms-live-link="'. route("TMS.Task.View.Id",\MS\Core\Helper\Comman::en4url($value1['AgentCurrentTask'])).'" >'.$value1['AgentCurrentTask']."</span>",
					 'Time Stamp : '.\Carbon::parse($value['created_at'])->toDayDateTimeString(),


					];

					
			$Finalarray[]=[

			'lat'=>$value['LAT'],
			'lng'=>$value['LNG'],
			'agentCode'=>(String)$key,
			'title'=>\B\AAMS\Model::getAgentCode($agentCode)['AgentName'],
			'details'=>implode("<br>", $details),

			];





		}


		$status=200;
		 return response()->json($Finalarray, $status);
	}

	public static function byAgencyCode($AgencyCode){
					$con=\B\AAMS\Base::getConnection(4);
					$table=\B\AAMS\Base::getTable(4,$AgencyCode);
					if(\B\AAMS\Model::checkTableinDB($con,$table)){

						$m2=new \B\AAMS\Model(4,$AgencyCode);

					

						$build=new \MS\Core\Helper\Builder ("B\AAMS");
					$model=$m2->where('id','>','0')->orderByDesc('created_at')->paginate(500);
					//dd($m2);
					//dd($m2->where('TaskId',$taskId)->get());
//MS\Core\Helper\Comman::DB_flush();
	//	dd($model);

						$diplayArray=[

				//'UniqId'=>'Trip ID',

				'TripCode'=>'Trip Code',

				'AgentCode'=>'Name of Agent',

				'created_at'=>'Start Date',
				'updated_at'=>'Last Update'


						];

						$link=[

			// 'delete'=>[
			// 	'method'=>'TMS.Task.Delete.Id',
			// 	'key'=>'UniqId',

			// ],

			// 'edit'=>[
			// 	'method'=>'AMS.Agency.Edit.Id',
			// 	'key'=>'UniqId',

			// ],


			'view'=>[
				'method'=>'LOC.Location.TripBy.UniqId',
				'key'=>'TripCode',

			],

			// 'AllocationLater'=>[
			// 	'method'=>'TMS.Task.Gen.Allocation',
			// 	'key'=>'UniqId',
			// ],

		];



						$build->listData($model)->listView($diplayArray)
											// ->btn([
											// 	'action'=>"\\B\\TMS\\Controller@taskAdd",
											// 	'color'=>"btn-info",
											// 	'icon'=>"fa fa-plus",
											// 	'text'=>"Add Task"
											// ]



											// )
											// ->btn( 
											// [
											// 	'action'=>"\\B\\TMS\\Controller@taskViewByColumn",
											// 	'color'=>"btn-default",
											// 	'icon'=>"fa fa-eye",
											// 	'text'=>"Group By Agency",
											// 	'data'=>'HireAgencyCode'
											// ])
											// ->btn( 
											// [
											// 	'action'=>"\\B\\TMS\\Controller@taskViewByColumn",
											// 	'color'=>"btn-default",
											// 	'icon'=>"fa fa-eye",
											// 	'text'=>"Group By State",
											// 	'data'=>'NameOperatorState'
											// ])
											// ->btn( 
											// [
											// 	'action'=>"\\B\\TMS\\Controller@taskViewByColumn",
											// 	'color'=>"btn-default",
											// 	'icon'=>"fa fa-eye",
											// 	'text'=>"Group By Month",
											// 	'data'=>'created_at'
											// ])
											->addListAction($link)->listGetter(['AgentCode','created_at','updated_at']);	

						return $build->view(true,'list');
					}

		

	}






}
