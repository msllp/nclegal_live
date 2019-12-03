<?php
namespace B\LOC;

class Controller extends \App\Http\Controllers\Controller
{
	public function __construct(){
     

        //$this->middleware('groupname')->except(['method_name']);
    }
	public function index(){




			$data=[

			

			];
		return view('LOC.V.panel_data')->with('data',$data);
		
		
	}


	public function indexData(){




			$data=[

			

			];
		return view('LOC.V.Object.MasterDetails')->with('data',$data);
		
		
	}

	public function postLocationFromandroid (R\GetLocationFromAndroid $r){
		\MS\Core\Helper\Comman::DB_flush();
		$input=$r->all();
		$m=new Model('1');
		$m->MS_add([

		'Lat'=>$input['lat'],
		'Lon'=>$input['lon'],
		'UserCode'=>"00.00",
		'AgencyCode'=>"00.00",
		'TaskCode'=>"00.00",
		'Status'=>true
			]);

		return "OK" ;


	}

	public function  postLocationJson(){
		
		\MS\Core\Helper\Comman::DB_flush();
		$m=new Model('1');
		$status=200;
		$array=$m->MS_all()->take(500)->sortBy('id');

		foreach ($array as $key => $value) {
			
			$Finalarray[]=[

			'lat'=>$value['Lat'],
			'lng'=>$value['Lon'],
			'id'=>$value['id'],		
			'created_at'=>$value['created_at']->toDayDateTimeString(),

			];






		}
		//dd($Finalarray);
		 return response()->json($Finalarray, $status);


	}


	public function agentViewAll(){


			$data=[

			

			];
		return view('LOC.V.Object.ViewAllAgent')->with('data',$data);
		
		

	}


	public function getAgentNLocation(){

		\MS\Core\Helper\Comman::DB_flush();
		$m=new Model('1');
		$status=200;
		$array=$m->MS_all()->take(500)->sortBy('id');

		\MS\Core\Helper\Comman::DB_flush();
		$m=new \B\AMS\Model(0);

		$Finalarray=[];

		if($m->MS_all()!=null && count($m->MS_all()) >0){

			

			foreach ($m->MS_all()->toArray()as $key => $value) {
			
			\MS\Core\Helper\Comman::DB_flush();
			$m1=new \B\AAMS\Model(3,$value['UniqId']  );
			

			if($m1->MS_all()!=null && count($m1->MS_all()) >0){
			
				


				foreach ($m1->MS_all()->toArray() as $key1 => $value1) {
				//	dd($value1);

					if($value1['AgentCurrentTask']==null)$value1['AgentCurrentTask']="No Task Assigned";

					$agencyName=\B\AMS\Logics::getAgencyName($value['UniqId']);

					$details=[
					"<img src='". asset('images/detective.svg') ."' style='max-height:32px;margin-bottom:5px;'>",
					'Agent Name: '.$value1['AgentName']." (".$value1['AgentContactNo'].")",
					"Agency : ".'<span class="ms-mod-btn text-info btn btn-sm" ms-live-link="'. route("AMS.Agency.View.Id",\MS\Core\Helper\Comman::en4url($value['UniqId'])).'" >'.$agencyName."</span>",
					//'Current Task Id : <span class="ms-mod-btn text-info btn btn-sm" ms-live-link="'. route("TMS.Task.View.Id",\MS\Core\Helper\Comman::en4url($value1['AgentCurrentTask'])).'" >'.$value1['AgentCurrentTask']."</span>",
					'Last Time Stamp : '.\Carbon::parse($value1['updated_at'])->toDayDateTimeString(),


					];

					if($value1['AgentCurrentTask']=="No Task Assigned")$details[3]="Current Task Id : ".$value1['AgentCurrentTask'];

					//dd($value1['updated_at']);

						$Finalarray[]=[

			'lat'=>$value1['AgentLastLAT'],
			'lng'=>$value1['AgentLastLNG'],
			'agentCode'=>strtoupper(str_split ($agencyName)[0].str_split ($agencyName)[1])."/".$value1['UniqId'],
			'title'=>$value1['AgentName'].",".$agencyName,
			'details'=>implode("<br>", $details) ,
			];
				}

			}


			}


//dd($Finalarray);
		}

		



		// foreach ($array as $key => $value) {
			
		// 	$Finalarray[]=[

		// 	'lat'=>$value['Lat'],
		// 	'lng'=>$value['Lon'],
		// 	'id'=>$value['id'],		
		// 	'created_at'=>$value['created_at']->toDayDateTimeString(),

		// 	];






		// }
		//dd($Finalarray);
		 return response()->json($Finalarray, $status);




	}


	public function searchTrips(){

		return view("LOC.V.Object.searchTrip");

	}


	public function searchTripData(\Illuminate\Http\Request $r){

		$input=$r->all();
		//dd($r->all());

		if(array_key_exists('TypeOfSearch' ,$input)) {


			switch ($input['TypeOfSearch']) {
				case '0':


					// \MS\Core\Helper\Comman::DB_flush();
					// $m1=new \B\AMS\Model();
					// $data=$m1->MS_all()->pluck('Name')->toArray();
					// //dd();

					// //$data=[];


                    \MS\Core\Helper\Comman::DB_flush();
                    $m2=new \B\AMS\Model();

                    $allAganecyData=$m2->MS_all()->pluck('Name','UniqId')->toArray();
                   

                    $Agenctdata=[];

                    foreach ($allAganecyData as $key => $value) {

                      \MS\Core\Helper\Comman::DB_flush();
                      $m3=new \B\AAMS\Model(3,$key);

                      if($m3->MS_all()->count() >0){

                        $con=\B\AAMS\Base::getConnection(4);
                        $table=\B\AAMS\Base::getTable(4,$key);


                        if( \B\AAMS\Model::checkTableinDB($con,$table)){

                        \MS\Core\Helper\Comman::DB_flush();
                        $m4=new \B\AAMS\Model(4,$key);

                        if($m4->MS_all()->count() > 0 ){

                          if(!array_key_exists($key, $Agenctdata))$Agenctdata[$key]=$value;

                        }

                      //  var_dump();



                        }



                      }

                      //var_dump();
                      # code...
                    }
					$status=200;
					$array=[
							'data'=>$Agenctdata,
					 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
					 		
						];

					return response()->json($array, $status);
					break;

				case '1':



					\MS\Core\Helper\Comman::DB_flush();




					$m2=new \B\AMS\Model();
					$mData=$m2->MS_all()->pluck('Name','UniqId');
					$taskHaveTrips=[];
					foreach ($mData as $key => $value) {
						
						
						//dd($m3->getConnection());
						$con=\B\AAMS\Base::getConnection(4);
						$table=\B\AAMS\Base::getTable(4,$key);
						//$taskHaveTrips=[];
						if(\B\AAMS\Model::checkTableinDB($con,$table)){

							$m3=new \B\AAMS\Model(4,$key);

							


							$allTask=$m3->get()->groupBy('TaskCode')->toArray();

							foreach ($allTask as $key1 => $value1) {
								//dd(!array_key_exists($key1, $taskHaveTrips));
								if(!array_key_exists($key1, $taskHaveTrips)){$taskHaveTrips[$key1]=count($value1);
								}else{

									$taskHaveTrips[$key1]=$taskHaveTrips[$key1]+ count($value1);
								}
							}
							//dd($taskHaveTrips);



						}

					}

					$types=array_keys($taskHaveTrips);

				//	dd($mData);

				//	$mData=array_flip($taskHaveTrips);

					$rData=[];

					foreach ($taskHaveTrips as $key=>$value) {

						$m2=new \B\TMS\Model(7);
						

						$taskDetails=$m2->where('UniqId',$key)->first()->toArray();
							
						//dd($m2->where('UniqId',$key)->first()->toArray());

						$rData[$key]=$taskDetails['UniqId'].",".$taskDetails['NameOperator'].", Agency: ". \B\AMS\Logics::getAgencyName($taskDetails['HireAgencyCode']). " (Trips:".$value.")" ;


					}

					$status=200;
					$array=[
							'data'=>$rData,
					 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
					 		
						];

					return response()->json($array, $status);
					break;

				case '2':
					\MS\Core\Helper\Comman::DB_flush();
					$m1=new \B\TMS\Model();
					$data=$m1->MS_all()->groupBy('NameOperatorState')->toArray();
					//dd();

					//$data=[];
					$status=200;
					$array=[
							'data'=>array_keys($data),
					 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
					 		
						];

					return response()->json($array, $status);
					break;



				case '3':
					\MS\Core\Helper\Comman::DB_flush();
					$m1=new \B\TMS\Model();
					$data=$m1->MS_all()->groupBy(
								function($d) {
								     return \Carbon::parse($d->created_at)->format('F,Y');

								 }
																	)->toArray();
					//dd();

					//$data=[];
					$status=200;
					$array=[
							'data'=>array_keys($data),
					 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
					 		
						];

					return response()->json($array, $status);
					break;
				
				default:
					# code...
					break;
			}


		}

				$status=422;
					$array=[
							'msg'=>["Invalid Input"],
					 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
					 		
						];

	
				return response()->json($array, $status);

	}

	public function getTrip($UniqId){

		$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);	

		return \B\AAMS\F\SearchTrips::viewTrip($UniqId);
		// $UniqIdExp=explode('_', $UniqId);	
		// $agencyCode=$UniqIdExp[0];
		// $agentCode=implode('_', [ $UniqIdExp[1],$UniqIdExp[2]  ]);
		// dd($agentCode);


	}

	public function getTripJson($UniqId){

		$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);	

		return \B\AAMS\F\SearchTrips::viewTripJson($UniqId);

	}

	public function searchTripsPost(\Illuminate\Http\Request $r ){


		$input=$r->all();
		//dd($r->all());

		if(array_key_exists('TypeOfSearch' ,$input)) {


			switch ($input['TypeOfSearch']) {


				case '0':
				\MS\Core\Helper\Comman::DB_flush();
				$AgencyCode=$input['QueryText'];

				//\B\AAMS\F\SearchTrips::byTaskId($TaskCode);
					$status=200;
					$array=[
							'Data'=>\B\AAMS\F\SearchTrips::byAgencyCode($AgencyCode)->render(),
					 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
					 		
						];

				break;


				case '1':
				\MS\Core\Helper\Comman::DB_flush();
				$TaskCode=$input['QueryText'];

				//\B\AAMS\F\SearchTrips::byTaskId($TaskCode);
					$status=200;
					$array=[
							'Data'=>\B\AAMS\F\SearchTrips::byTaskId($TaskCode)->render(),
					 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
					 		
						];

				break;


				default:
					# code...
					break;






			}


			return response()->json($array, $status);
		}


	



		dd($r->all());
	}

}