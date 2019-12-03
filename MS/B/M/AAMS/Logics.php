<?php
namespace B\AAMS;

class Logics{


	public static function makeAgentTable ($UniqId){



				\B\AAMS\Base::migrate([ 
					[
					'id'=>3,
					'code'=>$UniqId
					]
							]);


				return true ;


	}


	public static function makeAgent($agencyCode,$data){



			$status=200;
			$tableId=3;
			$rData=$data->all();
			
			//dd($rData);
			if(array_key_exists('AgentPasswordConfirm', $rData))unset( $rData['AgentPasswordConfirm']);
			if(array_key_exists('AgentPassword', $rData))$rData['AgentPassword']=\MS\Core\Helper\Comman::en($rData['AgentPassword']);
			if(!array_key_exists('AgentLastLAT', $rData))$rData['AgentLastLAT']="00.00";
			if(!array_key_exists('AgentLastLNG', $rData))$rData['AgentLastLNG']="00.00";
			if(!array_key_exists('AgentLoactionApiToken', $rData))$rData['AgentLoactionApiToken']= \MS\Core\Helper\Comman::en4url (\MS\Core\Helper\Comman::random(10));
			if(!array_key_exists('UniqId', $rData))$rData['UniqId']= explode("_", $rData['AgentCode'])[1];

			\MS\Core\Helper\Comman::DB_flush();
			
			$model=new Model($tableId,$agencyCode);
			$return=$model->MS_add($rData);

   			
   			\MS\Core\Helper\Comman::DB_flush();

				\B\AAMS\Base::migrate([ 
					[
					'id'=>2,
					'code'=>$rData['AgentCode']
					]
							]);



			


			$array=[
					'msg'=>"OK",
			 		'redirectData'=>action('\B\AAMS\Controller@indexData'),
			 		//'data'=>$input,
			 		//'array'=>$return

				];

			
		return [

		'data'=>$array,
		'status'=>$status

		];

	

	}


	public static function deleteAgent($agencyCode,$UniqId){

			$status=200;
			$tableId=3;
			$exUniqId=explode("_", $UniqId);
			$rData=['UniqId'=>reset($exUniqId)];
			
			$model=new Model($tableId,$agencyCode);
			$model->MS_delete($rData,$tableId,[ 'AgentCode'=>$UniqId]);	


			\MS\Core\Helper\Comman::DB_flush();
			$m2=new \B\AAMS\Model(2,$UniqId);
			//dd($m2->deleteTable());
			$m2->deleteTable();


				return [

		"data"=>['msg'=>"OK",'redirectModData'=>route( "AAMS.index.Data")],
		'status'=>$status

		];



	}

	public static function editAgent($agentCode,$data){

			$status=200;
			$tableId=3;

			$exAgentcode=explode("_", $agentCode);
			$UniqId=$exAgentcode[1];
			$agencyCode=reset($exAgentcode);

			if($data['AgentPassword']!=null){
				$data['AgentPassword']=\MS\Core\Helper\Comman::en($data['AgentPassword']);
			}

			$model=new Model($tableId,$agencyCode);
		
			//if($)
			$model->MS_update($data,$UniqId);	


			//\MS\Core\Helper\Comman::DB_flush();
			//$m2=new \B\AAMS\Model(2,$UniqId);
			//dd($m2->deleteTable());
			//$m2->deleteTable();


				return [

		"data"=>['msg'=>"OK",'redirectModData'=>route( "AAMS.index.Data")],
		'status'=>$status

		];



	}



	public static function loginAgent($input){

		\MS\Core\Helper\Comman::DB_flush();
		$agencyCode=$input['AgencyCode'];
		$status=200;
		$model=new Model(3,$agencyCode);

		//dd($model);

		$row=$model->where('AgentUsername',$input['UserName']);
		//dd(\MS\Core\Helper\Comman::de($row->get()->first()->toArray()['AgentPassword']));

		//$row->get()->first()->toArray()

		if($row->get()->first()!=null){

			$rowArray=$row->get()->first()->toArray();
	     $psw=\MS\Core\Helper\Comman::de($rowArray['AgentPassword']);

	     if($psw===$input['Password']){

	     	session()->put(['agent' => [
	       
	        'AgencyCode'=>$input['AgencyCode'],
	        'AgentCode'=>$rowArray['AgentCode'],
	        'ApiToken'=>$rowArray['AgentLoactionApiToken'],
	        'AgentData'=>$rowArray
	        
	        ] ]);

	     	//return ['status'=>200 ,'msg'=>'User Found'];

	     }


	 	}else{


	 		return ['status'=>422 ,'data'=>['msg'=>['Agent not Found.','Please Select valid Agency.','Please Note Username is Case Senstive.']]];
	 	}
	 
			$array=[
					'msg'=>"OK",
			 		'redirect'=>route('AAMS.Agent.Panel'),
			 		//'data'=>$input,
			 		//'array'=>$return

				];

			
		return [

		'data'=>$array,
		'status'=>$status

		];
		return $input;



	}

	public static function agentLocationStamp($input){


		$agencyCode=$input['AgencyCode'];
	  	

	    if($input['AgencyCode'] != 'AgencyCode')
		{




			
			\MS\Core\Helper\Comman::DB_flush();
				$m=new Model(3,$agencyCode);
				$agent=$m->where('AgentCode',$input['AgentCode'])->first()->toArray();
		
				
				

				if($agent['AgentLoactionApiToken'] === $input['ApiToken']){
		
				$m->MS_update(
		
					[
					'AgentLastLAT'=>$input['lat'],
					'AgentLastLNG'=>$input['lon']
					],
		$agent['UniqId']
					);

				$currentTask=$m->where('AgentCode',$input['AgentCode'])->get()->first()->toArray()['AgentCurrentTask'];
				\MS\Core\Helper\Comman::DB_flush();
				$m2=new Model(4,$agencyCode);

				$tripCode=Base::genrateTripCode($currentTask,$input['AgentCode']);

				
				if($m2->where('TripCode',$tripCode)->get()->first() !=null){
				//	dd($m2->where('TripCode',$tripCode)->get()->first());
					$tripUniqId=$m2->where('TripCode',$tripCode)->get()->first()->toArray()['UniqId'];
					$m2->MS_update(
						[
						'LastLat'=>$input['lat'],
						'LastLNG'=>$input['lon'],
						//'TripCode'=>$tripCode,
						]
					,$tripUniqId);

					\MS\Core\Helper\Comman::DB_flush();
					$m3=new Model(5,$tripCode);
					//dd($tripCode);
					if(count($m3->MS_all()->toArray()) > 0){


						$lastLocation=$m3->MS_all()->last()->toArray();
				
						if( ($input['lat'] !== $lastLocation['LAT']) or ($input['lon'] !== $lastLocation['LNG'])   ){

								$m3->MS_add(
							[
							'LAT'=>$input['lat'],
							'LNG'=>$input['lon'],
							]

							);

						}

						//dd($lastLocation);

					}else{


						$m3->MS_add(
							[
							'LAT'=>$input['lat'],
							'LNG'=>$input['lon'],
							]

							);
					}

					


				}else{

					$tripUniqId=$m2->MS_add(

						[
						'TaskCode'=>$currentTask,
						'TripCode'=>$tripCode,
						'AgentCode'=>$input['AgentCode'],
						'LastLat'=>$input['lat'],
						'LastLNG'=>$input['lon'],
						'MacAddress'=>"00:00:00:00:00",
						'DeviceName'=>'Android Phone',
						'LoginIP'=>'127.0.0.1',
						]
						);

					$tripData=Base::migrate([

						[
						'id'=>5,
						'code'=>$tripCode
						]

						]);

					\MS\Core\Helper\Comman::DB_flush();
					$m3=new Model(5,$tripCode);

					if(count($m3->MS_all()->toArray()) > 0){


						$lastLocation=$m3->MS_all()->last()->toArray();
				
						if( ($input['lat'] !== $lastLocation['LAT']) or ($input['lon'] !== $lastLocation['LNG'])   ){

								$m3->MS_add(
							[
							'LAT'=>$input['lat'],
							'LNG'=>$input['lon'],
							]

							);

						}

						//dd($lastLocation);

					}else{


						$m3->MS_add(
							[
							'LAT'=>$input['lat'],
							'LNG'=>$input['lon'],
							]

							);
					}







				}

				
				




				}






			

		}



		return ['status'=>200 ,'msg'=>'Ok'];

	}

	public static function  agentLogout(){

		session()->forget('agent');

	}


	public static function agentTask($input){

		//dd($input);

		$agent=[
		'TaskCode'=>$input['TaskCode'],
		'AgencyCode'=>session('agent.AgencyCode'),
		'AgentCode'=>session('agent.AgentCode'),
		];

	//	dd($agent);
		\MS\Core\Helper\Comman::DB_flush();

		
		$table=Base::getTable(4,$agent['AgencyCode']);
		$connection=Base::getConnection(4);
		

		if(\Schema::connection($connection)->hasTable($table)){
		
			$m=new Model(4,$agent['AgencyCode']);



		}else{


			Base::migrate([

				[
				'id'=>4,
				'code'=>$agent['AgencyCode']
				]

				]);

			$m=new Model(4,$agent['AgencyCode']);


		}


		if(count($m->where('TaskCode',$agent['TaskCode'])->where('AgentCode',$agent['AgentCode'])->get()->toArray()) < 1){

			$tripCode=
			Base::genrateTripCode($agent['TaskCode'],$agent['AgentCode']);

			$tripRow=[
			'TaskCode'=>$agent['TaskCode'],
			'TripCode'=>$tripCode,
			'AgentCode'=>$agent['AgentCode'],
			'LastLat'=>"00.00",
			'LastLNG'=>"00.00",
			'MacAddress'=>"00:00:00:00:00",
			'DeviceName'=>"Test DeviceName",
			'LoginIP'=>"127.0.0.1",


			];


			$m->MS_add($tripRow);


			$table=Base::getTable(5,$tripCode);
		    $connection=Base::getConnection(5);
		

		if(!\Schema::connection($connection)->hasTable($table)){
		

			$tripData=Base::migrate([

				[
				'id'=>5,
				'code'=>$tripCode
				]

				]);




		}




			//dd($tripData);

			\MS\Core\Helper\Comman::DB_flush();

			$m2=new Model(3,$agent['AgencyCode']);

			$UniqId=explode("_", $agent['AgentCode']);
			//dd($UniqId);
			//'AgentCurrentTask'
			$m2->MS_update(

				['AgentCurrentTask'=>$agent['TaskCode'],],$UniqId[1]

				);



		//	session()
			

		}else{
			\MS\Core\Helper\Comman::DB_flush();
			$m2=new Model(3,$agent['AgencyCode']);

			$UniqId=explode("_", $agent['AgentCode']);
			//dd($agent['AgentCode']);

			$recentTask=$m2->where('UniqId',"=",$UniqId[1])->get()->first()->toArray()['AgentCurrentTask'];
			//dd();

			$m2->MS_update(

				[

				'AgentCurrentTask'=>$agent['TaskCode'],
				'AgentLastTask'=>$recentTask

				],$UniqId[1]

				);

			$tripCode=Base::genrateTripCode($agent['TaskCode'],$agent['AgentCode']);
			\MS\Core\Helper\Comman::DB_flush();
			$m3=new Model(4,$agent['AgencyCode']);
			//dd($m3->where('TripCode',"=",$tripCode)->get()->first());
			if($m3->where('TripCode',"=",$tripCode)->get()->first() ==null ){

				$tripUniqId=$m3->MS_add(

						[
						'TaskCode'=>$agent['TaskCode'],
						'TripCode'=>$tripCode,
						'AgentCode'=>$agent['AgentCode'],
						'LastLat'=>"00.00",
						'LastLNG'=>"00.00",
						'MacAddress'=>"00:00:00:00:00",
						'DeviceName'=>'Android Phone',
						'LoginIP'=>'127.0.0.1',
						]
						);

				//dd($tripUniqId);

					$tripData=Base::migrate([

						[
						'id'=>5,
						'code'=>$tripCode
						]

						]);

			}
			

			


			
			//$first=$m->where('TaskCode',$agent['TaskCode'])->where('AgentCode',$agent['AgentCode'])->first()->toArray();
			
			//dd($m2);

		}


			$status=200;
			$array=[
					'msg'=>"OK",
			 		'redirectData'=>route('AAMS.Agent.Panel.Data'),
			 		//'data'=>$input,
			 		//'array'=>$return

				];

			
		return [

		'data'=>$array,
		'status'=>$status

		];


		


	}
	  public static function getAgentCode($UniqId){

       // dd($UniqId);

        $AgentCode=$UniqId;
        $AgencyCode=explode('_', $AgentCode)[0];
        $m=new \B\AAMS\Model (3,$AgencyCode);

        if($m->where('AgentCode', $AgentCode)->get()->count() > 0){

        	$agent=$m->where('AgentCode', $AgentCode)->get()->first()->toArray();
        	//dd($agent);
        	return $agent['AgentName']." ( ".$agent['AgentContactNo']." ) ";
        }else{
        return"Agent does not Found/Deleted";	
        }
        //dd($UniqId);
        //dd($m->where('AgentCode', $AgentCode)->get());

    }




   public static function  getcreated_at($date){

   	return  \Carbon::parse($date)->toDayDateTimeString();


   }

    public static function  getupdated_at($date){

   	return  \Carbon::parse($date)->toDayDateTimeString();


   }



    
}