<?php
namespace B\TMS;

class Logics{
	


	public static function checkTaskUniqIdForNew( $UniqId ){
		//dd( $UniqId);
		//$UniqId=471;
		$return =[];
		\MS\Core\Helper\Comman::DB_flush();
		$model=new Model (7);
		$m1=$model ->where('UniqId',$UniqId)->get();
		//dd($m1->count());
		
		if($m1->count() > 0) {

			while ( $model ->where('UniqId',$UniqId)->get() -> count() > 0) {

				$UniqId= \MS\Core\Helper\Comman::random(2,1);
				
			}
				$return['status']=0;
				$return['NewId']=$UniqId;

			}else{

				$return['status']=1;
				$return['msg']="Task id can Generate";

			}
		

		return $return;
	}


	public static function getHireAgencyCode($code){


		

		$model=new \B\AMS\Model (0);

		//dd($model->getHireAgencyCodeFromId($code));

		return $model->getHireAgencyCodeFromId($code);


	}




	public static function getTypeOfAction($code){


		$model=new \B\TMS\Model (0);
		\MS\Core\Helper\Comman::DB_flush();


		//dd($model->getTypeOfActionFromId($code));



		return $model->getTypeOfActionFromId($code);
	}


	public static function  getCurrentStatus($code){


		
		\MS\Core\Helper\Comman::DB_flush();
		$model=new Model (7);

		//dd($model->getHireAgencyCodeFromId($code));

		return $model->getCurrentStatuseFromId($code);


	}



	public static function setCurrentStatusfroEvent($TaskId,$ActionType,$hasInvoice=false){

		\MS\Core\Helper\Comman::DB_flush();
		$m2=new \B\TMS\Model ();
		if($hasInvoice){
			$m2->MS_update(['CurrentStatus'=>$ActionType,'HasInvoice'=>1],$TaskId);		
		}else{

			$m2->MS_update(['CurrentStatus'=>$ActionType],$TaskId);			
		}
		


	}



	public static function takeActionOnFileById($TaskId,$StepId,$FileId,$FileAction){

		\MS\Core\Helper\Comman::DB_flush();
		$m2=new \B\TMS\Model (1,$TaskId);

		//dd($m2->where('UniqId',$StepId)->first()->toArray());
		$stepData=$m2->where('UniqId',$StepId)->first()->toArray();
		$stepData['DocumentArray']=json_decode($stepData['DocumentArray'],true);
		$stepData['DocumentQueryArray']=json_decode($stepData['DocumentQueryArray'],true);
		$stepData['DocumentReplyArray']=json_decode($stepData['DocumentReplyArray'],true);
		$stepData['DocumentVerifiedArray']=json_decode($stepData['DocumentVerifiedArray'],true);
		$stepData['DocumentRejectedArray']=json_decode($stepData['DocumentRejectedArray'],true);


		switch ($FileAction) {
			case '1':
					\MS\Core\Helper\Comman::DB_flush();
					\B\TMS\Logics::setCurrentStatusfroEvent($TaskId,'7');

					\MS\Core\Helper\Comman::DB_flush();	
					$c4n=\MS\Core\Helper\Comman::random(4);
// 					\B\ANMS\Logics::newNotification(
// $stepData['HireAgencyCode']
// 						,
// 						1,
// 						$c4n,
// 						555,				
// 						' For Task No.'.$TaskId.', Step No.'.$StepId.', Document No. '.$FileId,
// 						route('ANMS.Notification.By.Id',
						
// 						['UniqId'=>
// 													\MS\Core\Helper\Comman::en4url($c4n)]),
// 							route('ATMS.Task.Rise.Step.View',
						
// 						['TaskId'=>
// 													\MS\Core\Helper\Comman::en4url($TaskId),
// 						'StepId'=>
// 													\MS\Core\Helper\Comman::en4url($StepId)]
// 													)
// 						);

					\MS\Core\Helper\Comman::DB_flush();	
					$c4n=\MS\Core\Helper\Comman::random(4);
					\B\NMS\Logics::newNotification(

						session('user.userData.UniqId'),
						1,
						$c4n,
						666,				
						' For Task No.'.$TaskId.', Step No.'.$StepId.', Document No. '.$FileId,
						route('NMS.Notification.By.Id',
						
						['UniqId'=>
													\MS\Core\Helper\Comman::en4url($c4n)]),
							route('TMS.Task.Rise.Step.Query.View',
						
						['TaskId'=>
													\MS\Core\Helper\Comman::en4url($TaskId),
						'StepId'=>
													\MS\Core\Helper\Comman::en4url($StepId)]
													)
						);




				
				//	dd($stepData['DocumentQuery']);


					if(array_key_exists($FileId, $stepData['DocumentReplyArray'])){
	
						$stepData['DocumentVerifiedArray'][$FileId]=$stepData['DocumentReplyArray'][$FileId]['ReplayDocumentArray'];
						\MS\Core\Helper\Comman::DB_flush();
						$m1=new \B\TMS\Model (1,$TaskId);

						if(count($stepData['DocumentVerifiedArray']) == count($stepData['DocumentArray'])){
							$stepData['DocumentVerified']=1;
							$stepData['VerifiedBy']=session('user.userData.UniqId');
							
						}

						$m1->MS_update([
							'VerifiedBy'=>$stepData['VerifiedBy'],
							'DocumentVerified'=>$stepData['DocumentVerified'],
							'DocumentVerifiedArray'=>collect($stepData['DocumentVerifiedArray'])->toJson()	 ],$StepId);




					}else{
						
						if(!$stepData['DocumentQuery'] && !$stepData['DocumentReply']){

	
						
						foreach ($stepData['DocumentArray'] as $key => $value) {


							if($value['UniqId'] == $FileId){



								$stepData['DocumentVerifiedArray'][$FileId]=$stepData['DocumentArray'][$key];
								

								if($stepData['DocumentVerifiedArray'][$FileId]['TypeOfDocument'] == '777' or $stepData['DocumentVerifiedArray'][$FileId]['TypeOfDocument'] == '888'){

									//dd();
								}
								//dd($stepData['DocumentVerifiedArray'][$FileId]);
							}

							# code...
						}

					
						\MS\Core\Helper\Comman::DB_flush();
						$m1=new \B\TMS\Model (1,$TaskId);

						if(count($stepData['DocumentVerifiedArray']) == count($stepData['DocumentArray'])){
							$stepData['DocumentVerified']=1;
							$stepData['VerifiedBy']=session('user.userData.UniqId');
						}


						


						$m1->MS_update([
							'VerifiedBy'=>$stepData['VerifiedBy'],
							'DocumentVerified'=>$stepData['DocumentVerified'],
							'DocumentVerifiedArray'=>collect($stepData['DocumentVerifiedArray'])->toJson()	 ],$StepId);




						}else{


							if(!$stepData['DocumentQuery'])
							{		
								foreach ($stepData['DocumentArray'] as $key => $value) {
				
				
											if($value['UniqId'] == $FileId){
				
												$stepData['DocumentVerifiedArray'][$FileId]=$stepData['DocumentArray'][$key];
				
											}
				
											# code...
										}
									
										\MS\Core\Helper\Comman::DB_flush();
										$m1=new \B\TMS\Model (1,$TaskId);
				
										if(count($stepData['DocumentVerifiedArray']) == count($stepData['DocumentArray'])){
											$stepData['DocumentVerified']=1;
											$stepData['VerifiedBy']=session('user.userData.UniqId');
										}
				
				
										$m1->MS_update([
											'VerifiedBy'=>$stepData['VerifiedBy'],
											'DocumentVerified'=>$stepData['DocumentVerified'],
											'DocumentVerifiedArray'=>collect($stepData['DocumentVerifiedArray'])->toJson()	 ],$StepId);
				
				}


						}

					}
				



				break;

				case '0':
					
						\MS\Core\Helper\Comman::DB_flush();	
					$c4n=\MS\Core\Helper\Comman::random(4);
					// \B\ANMS\Logics::newNotification(

					// 	$stepData['HireAgencyCode'],
					// 	1,
					// 	$c4n,
					// 	666,				
					// 	' For Task No.'.$TaskId.', Step No.'.$StepId.', Document No. '.$FileId,
					// 	route('ANMS.Notification.By.Id',
						
					// 	['UniqId'=>
					// 								\MS\Core\Helper\Comman::en4url($c4n)]),
					// 		route('ATMS.Task.Rise.Step.View',
						
					// 	['TaskId'=>
					// 								\MS\Core\Helper\Comman::en4url($TaskId),
					// 	'StepId'=>
					// 								\MS\Core\Helper\Comman::en4url($StepId)]
					// 								)
					// 	);

						\MS\Core\Helper\Comman::DB_flush();	
					$c4n=\MS\Core\Helper\Comman::random(4);
					\B\NMS\Logics::newNotification(

						session('user.userData.UniqId'),
						1,
						$c4n,
						666,				
						' For Task No.'.$TaskId.', Step No.'.$StepId.', Document No. '.$FileId,
						route('NMS.Notification.By.Id',
						
						['UniqId'=>
													\MS\Core\Helper\Comman::en4url($c4n)]),
							route('TMS.Task.Rise.Step.Query.View',
						
						['TaskId'=>
													\MS\Core\Helper\Comman::en4url($TaskId),
						'StepId'=>
													\MS\Core\Helper\Comman::en4url($StepId)]
													)
						);

				//	dd($stepData['DocumentQuery']);

					if(array_key_exists($FileId, $stepData['DocumentReplyArray'])){
	
						$stepData['DocumentRejectedArray'][$FileId]=$stepData['DocumentReplyArray'][$FileId]['ReplayDocumentArray'];
						\MS\Core\Helper\Comman::DB_flush();
						$m1=new \B\TMS\Model (1,$TaskId);

						if(count($stepData['DocumentRejectedArray']) == count($stepData['DocumentArray'])){
							$stepData['DocumentRejected']=1;
							$stepData['VerifiedBy']=session('user.userData.UniqId');
							
						}
				

						$m1->MS_update([
							'VerifiedBy'=>$stepData['VerifiedBy'],
							'DocumentRejected'=>$stepData['DocumentRejected'],
							'DocumentRejectedArray'=>collect($stepData['DocumentRejectedArray'])->toJson()	 ],$StepId);




					}else{

						if(!$stepData['DocumentQuery'] && !$stepData['DocumentReply']){


						
						foreach ($stepData['DocumentArray'] as $key => $value) {


							if($value['UniqId'] == $FileId){

								$stepData['DocumentRejectedArray'][$FileId]=$stepData['DocumentArray'][$key];

							}

							# code...
						}
					
						\MS\Core\Helper\Comman::DB_flush();
						$m1=new \B\TMS\Model (1,$TaskId);

						if(count($stepData['DocumentRejectedArray']) == count($stepData['DocumentArray'])){
							$stepData['DocumentRejected']=1;
							$stepData['VerifiedBy']=session('user.userData.UniqId');
						}


						


						$m1->MS_update([
							'VerifiedBy'=>$stepData['VerifiedBy'],
							'DocumentRejected'=>$stepData['DocumentRejected'],
							'DocumentRejectedArray'=>collect($stepData['DocumentRejectedArray'])->toJson()	 ],$StepId);




						}else{


							if(!$stepData['DocumentQuery'])
				{			foreach ($stepData['DocumentArray'] as $key => $value) {
				
				
											if($value['UniqId'] == $FileId){	

											//	dd($stepData['DocumentRejectedArray']);
										
												$stepData['DocumentRejectedArray'][$FileId]=$stepData['DocumentArray'][$key];
				
											}
				
											# code...
										}
									
										\MS\Core\Helper\Comman::DB_flush();
										$m1=new \B\TMS\Model (1,$TaskId);
				
										if(count($stepData['DocumentRejectedArray']) == count($stepData['DocumentArray'])){
											$stepData['DocumentRejected']=1;
											$stepData['VerifiedBy']=session('user.userData.UniqId');
										}
				
				
										$m1->MS_update([
											'VerifiedBy'=>$stepData['VerifiedBy'],
											'DocumentRejected'=>$stepData['DocumentRejected'],
											'DocumentRejectedArray'=>collect($stepData['DocumentRejectedArray'])->toJson()	 ],$StepId);
				
				}


						}

					}
				



				break;
			
			default:
				# code...
				break;
		}




		//dd($stepData);


	}



	public static function inWardInvoice($TaskId,$StepId,$FileId,$FileArray){


		\MS\Core\Helper\Comman::DB_flush();
		
		$m=new \B\TMS\Model(7);

		//if()

		if($m->where('UniqId',$TaskId)->get()->count() > 0 ){	

			$TaskRaw=$m->where('UniqId',$TaskId)->first()->toArray();

		//	dd($TaskRaw['HasInvoice']);
			if(!$TaskRaw['HasInvoice'])$m->MS_update(['HasInvoice'=>1],$TaskId);

			return \B\IM\Logics::genInvoice($TaskId,$StepId,$FileId,$FileArray);
		
			
			

		}

		return false;
		


	}


	public static function deleteInWardInvoice($TaskId,$StepId,$FileId){

			\MS\Core\Helper\Comman::DB_flush();
		
		$m=new \B\TMS\Model(7);

		//if()

		if($m->where('UniqId',$TaskId)->get()->count() > 0 ){	

			$TaskRaw=$m->where('UniqId',$TaskId)->first()->toArray();

			//	dd($TaskRaw['HasInvoice']);
			//if(!$TaskRaw['HasInvoice'])$m->MS_update(['HasInvoice'=>1],$TaskId);

			return \B\IM\Logics::deleteInvoice($TaskId,$StepId,$FileId);
		
			
			

		}

	}



	public static function getStatusCodeFromActionName($name){

		\MS\Core\Helper\Comman::DB_flush();
		$m=new \B\TMS\Model(6);
		//dd($m->get()->toArray());
		return $m->where('NameOfAction',$name)->first()->toArray()['UniqId'];


	}




	public static function uploadDocument($UniqId,$r){



		$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);
		$input=$r->all();

		$dataArray=[];

		\MS\Core\Helper\Comman::DB_flush();	
		$c4n=\MS\Core\Helper\Comman::random(4);
		
		\B\NMS\Logics::newNotification(

				session('user.userData.UniqId'),
				1,
				$c4n,
				222,				
				' by '.\B\Users\Logics::getUserName(session('user.userData.UniqId')) .' For task No.'.$UniqId,
				route('NMS.Notification.By.Id',
				
				['UniqId'=>
											\MS\Core\Helper\Comman::en4url($c4n)]),
					route('TMS.Task.View.Id',
				
				['UniqId'=>
											\MS\Core\Helper\Comman::en4url($UniqId)])
				);





		foreach ($input['TypeOfDocuments'] as $key => $value) {
		

			$dataArray[$key]=[


				'type'=>$input['TypeOfDocuments'][$key],
				'date'=>$input['DateOfDocument'][$key],
		
			];

			if(array_key_exists('NoOfDocument', $input)){

				if(array_key_exists($key, $input['NoOfDocument'])){

					$dataArray[$key]['NoOfDocument']=$input['NoOfDocument'][$key];

				}

			}

			if(array_key_exists('AmountOfDocument', $input)){

				if(array_key_exists($key, $input['AmountOfDocument'])){

					$dataArray[$key]['AmountOfDocument']=$input['AmountOfDocument'][$key];

				}

			}

				if(array_key_exists('OtherText', $input)){

				if(array_key_exists($key, $input['OtherText'])){

					$dataArray[$key]['OtherText']=$input['OtherText'][$key];

				}

			}



			if(array_key_exists('agencyDocument', $input)){

				if(array_key_exists($key, $input['agencyDocument'])){

					$dataArray[$key]['file']=$input['agencyDocument'][$key];

				}else{

					$status=402;
					$array=[
					'msg'=>[ 'Please select all to upload.' ],
			 		

				];

	
				 return response()->json($array, $status);

				}

			}




		}




		\MS\Core\Helper\Comman::DB_flush();

		$m4=\B\ATMS\Base::getTypeofDocuments();


		$path=[];


		foreach ($m4 as $key => $value) {
			$path[$key]='Data'.DIRECTORY_SEPARATOR.$UniqId.DIRECTORY_SEPARATOR.$key;
		}

		
		//dd($path);

			$alltype=\B\ATMS\Base::getTypeofDocuments();
			$disk='ATMS';
			$filePath=[];
			//dd($alltype);

$c1=Base::genUniqID();

		foreach ($dataArray as $key => $value) {

				$fileUniqId=\B\TMS\Base::genUniqID();
				if($value['type'] == "000"){

					$fileName=$value['OtherText']."_".$fileUniqId.".".$value['file']->getClientOriginalExtension();
				}else{

				$fileName=$alltype[$value['type']] ."_".$fileUniqId.".".$value['file']->getClientOriginalExtension();	
				}
				$filePath[$fileName]['path']=$value['file']->storeAs($path[$value['type']], $fileName, $disk);
				$filePath[$fileName]['UniqId']=$fileUniqId;
				$filePath[$fileName]['DateOfDocument']=$value['date'];
				$filePath[$fileName]['TypeOfDocument']=$value['type'];
				$filePath[$fileName]['NameOfDocument']=$key;
				if(array_key_exists('NoOfDocument', $value))$filePath[$fileName]['NoOfDocument']=$value['NoOfDocument'];

				if(array_key_exists('AmountOfDocument', $value))$filePath[$fileName]['AmountOfDocument']=$value['AmountOfDocument'];

			if($filePath[$fileName]['TypeOfDocument'] =='777' || $filePath[$fileName]['TypeOfDocument'] == '888' ){

				
				Logics::inWardInvoice($UniqId,$c1,$filePath[$fileName]['UniqId'],$filePath[$fileName]);
					
			}

		}


	\MS\Core\Helper\Comman::DB_flush();
		$m1=new \B\TMS\Model('1',$UniqId);


		

		$dbArray=[

			'UniqId'=>$c1,
			'TypeOfAction'=>'8',
			'DocumentUploaded'=>true,
			'DocumentArray'=>json_encode($filePath,true,3),
			'DocumentVerified'=>true,
			'DocumentVerifiedArray'=>json_encode($filePath,true),
			'VerifiedBy'=>session('user.userData.UniqId'),
			'TakenBy'=>session('user.userData.UniqId'),
			'DocumentQuery'=>false,
			'DocumentQueryArray'=>json_encode([],true,3),
			'DocumentReply'=>false,
			'DocumentReplyArray'=>json_encode([],true,3),
			'QueryRisedBy'=>null,

		];

		

		$m1->MS_add($dbArray);

		\B\TMS\Logics::setCurrentStatusfroEvent($UniqId,'8');

		\MS\Core\Helper\Comman::DB_flush();
		$m=new \B\TMS\Model();
		//dd($m);
		
		if($m->where('UniqId',$UniqId)->first()!=null){$rowData=$m->where('UniqId',$UniqId)->first()->toArray();}
		else{$rowData=[];}
		
		\B\NMS\Logics::readNotificationForAdmin($rowData,$m);

		$status=200;
			$array=[
					'msg'=>'OK',
					'redirectData'=>action('\B\TMS\Controller@taskViewById',['UniqId'=>\MS\Core\Helper\Comman::en4url($UniqId)] ),
					

				];

				return response()->json($array, $status);
	



	}


	public static function deleteStep($TaskId,$StepId){

		$TaskId=\MS\Core\Helper\Comman::de4url($TaskId);
		$StepId=\MS\Core\Helper\Comman::de4url($StepId);

		$m=new \B\TMS\Model('1',$TaskId);

		$data=$m->where('UniqId',$StepId)->first()->toArray();


		$data['DocumentArray']=json_decode($data['DocumentArray'],true);

	
		foreach ($data['DocumentArray'] as $key => $value) {

		

			if($value['TypeOfDocument'] == '777' ||  $value['TypeOfDocument'] == '888' )
			Logics::deleteInWardInvoice($TaskId,$StepId,$value['UniqId']);

		 

		\Storage::disk('ATMS')->delete(str_replace('\\', '/', $value['path']));


		}



		$m->where('UniqId',$StepId)->delete();






		$status=200;
			$array=[
					'msg'=>'OK',
					'redirectModData'=>action('\B\TMS\Controller@taskViewById',['UniqId'=>\MS\Core\Helper\Comman::en4url($TaskId)] ),
					

				];

				return response()->json($array, $status);
	




	}

    public static function getTaskRaw($code,$debug=false){
        \MS\Core\Helper\Comman::DB_flush();
        $m1=new Model(7);
        $actionType=[];


      //if ($m1->where('UniqId',$code)->get() !=  null)dd($m1->where('UniqId',$code)->get()->count());
        if ($m1->where('UniqId',$code)->get()->count() >  0) {

            $actionType=$m1->where('UniqId',$code)->get()->first()->toArray();

            //dd($actionType['NameOfAction']);
            # code...
        }
       // if($debug)dd($code);
        //dd($actionType);
        return $actionType;





    }

    public static function  getcreated_at($date){

        return  \Carbon::parse($date)->toDayDateTimeString();


    }

    public static function  getupdated_at($date){

        return  \Carbon::parse($date)->toDayDateTimeString();


    }


    public static function getTotalTask(){

    	\MS\Core\Helper\Comman::DB_flush();
        $m1=new Model(7);

        return $m1->where('Status',0)->get()->count();	
    }


    public static function getUserTaskFromId($user){

    	\MS\Core\Helper\Comman::DB_flush();
        $m1=new Model(7);
        return $m1->where('Status',0)->get()->count();	


    }





            public static function TaskNotify($TaskId,$AgencyCode,$ActionType){



			\MS\Core\Helper\Comman::DB_flush();	
			$c4n=\MS\Core\Helper\Comman::random(4);
			
			\B\NMS\Logics::newNotification(
				session('user.userData.UniqId'),
				1,
				$c4n,
				$ActionType,				
				' no.'.$TaskId." & assigned to ". \B\AMS\Logics::getAgencyName($AgencyCode)." by ".\B\Users\Logics::getUserName(session('user.userData.UniqId')),
				route('NMS.Notification.By.Id',
				['UniqId'=>\MS\Core\Helper\Comman::en4url($c4n)]),
                route('TMS.Task.View.Id',
				['UniqId'=>\MS\Core\Helper\Comman::en4url($TaskId)])
				);

			\MS\Core\Helper\Comman::DB_flush();

			//dd($AgencyCode);
			\B\ANMS\Logics::newNotification(
			
							$AgencyCode,
							1,
							$c4n,
							$ActionType,				
							' no.'.$TaskId,
							route('ANMS.Notification.By.Id',
							
							['UniqId'=>
														\MS\Core\Helper\Comman::en4url($c4n)]),
								route('ATMS.Task.View.Id',
							
							['UniqId'=>
														\MS\Core\Helper\Comman::en4url($TaskId)])
							);

}


public static function closeEntryToDB($TaskId){
		\MS\Core\Helper\Comman::DB_flush();	
		$idForTask=9;

		$invoiceData=\B\IM\Logics::getInvoiceByTaskId($TaskId);
		//$c4n=\MS\Core\Helper\Comman::random(4);
		if(!array_key_exists('Total',$invoiceData))$invoiceData['Total']=0;
		$fData=[
			//'UniqId'=>$c4n,
			'TaskId'=>$TaskId,
			'StarApr'=>'',
			'Invoice'=>'',
			'Total'=>$invoiceData['Total'],
			'TotalPaid'=>0,

		];


		$m=new Model($idForTask);
		if($m->where('TaskId',$TaskId)->get()->count() > 0){

				
				unset($fData['TaskId']);
				//unset($fData['TaskId']);

				$m->MS_update($fData,$m->where('TaskId',$TaskId)->get()->first()->toArray()["UniqId"]);

		}else{
			$m->MS_add($fData);

		}
		


}


public static function CreateInvoice($TaskId,$input){

	//dd();
	$taskData=self::getTaskRaw($TaskId);
	$AgencyCode=$taskData['HireAgencyCode'];

	\B\IM\F\Invoice::checkLedgerOrMakeLeder($AgencyCode);

	\B\IM\F\Invoice::inWardInvoiceForAgencyLedger($AgencyCode,$TaskId,$input);


}


}