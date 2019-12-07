<?php
namespace B\TMS;
use Illuminate\Http\Request;
class Controller extends \App\Http\Controllers\Controller
{
	public function __construct(){
     
		$this->middleware('backend');
        //$this->middleware('groupname')->except(['method_name']);
    }
	public function index(){
			\MS\Core\Helper\Comman::DB_flush();


			Base::migrate(
[
		[
		'id'=>9
		]]

				);

	
			$data=[

			

			];
		return view('TMS.V.panel_data')->with('data',$data);
		
		
	}


	public function indexData(){




			$data=[

			

			];
		return view('TMS.V.Object.MasterDetails')->with('data',$data);
		
		
	}


	public function taskAdd(){
		\MS\Core\Helper\Comman::DB_flush();

//
//		$m=new Model (7);
//		$allTask=$m->get()->toArray();
//
//		dd($allTask);
//
//		foreach ($allTask as $key => $value) {
//
//		\MS\Core\Helper\Comman::DB_flush();
//		if(!array_key_exists('UniqId',$value))dd($value);
//		$m2=new Model(1,$value['UniqId']);
//		$user=$m2->get()->first()->TakenBy;
//		\MS\Core\Helper\Comman::DB_flush();
//		$m3=new Model(7);
//		$m3->MS_update(['TakenBy'=>$user],$value['UniqId']);
//
//		//dd($user);
//
//
//		}
//
//	//	dd();

		$id=0;
		$build=new \MS\Core\Helper\Builder (__NAMESPACE__);



		$build->title("Assign Task to Agency")->heading(['Basic Details of APR ,Received from STAR'])->content($id)->action("taskAddPost")->btn([
								'action'=>"\\B\\TMS\\Controller@taskView",
								'color'=>"btn-info",
								'icon'=>"fa fa-fast-backward",
								'text'=>"Back"
							])->btn([
								//'action'=>"\\B\\MAS\\Controller@addCCPost",
								'color'=>"btn-success",
								'icon'=>"fa fa-floppy-o",
								'text'=>"Save"
							]);
		// $build->title("Add Agency")->heading(['Basic Details of Agency'])->content($id)->action("agencyAdd")->btn([
		// 						'action'=>"\\B\\AMS\\Controller@indexData",
		// 						'color'=>"btn-info",
		// 						'icon'=>"fa fa-fast-backward",
		// 						'text'=>"Back"
		// 					])->heading(['Conern Person Details'])->extraFrom('2')->heading(['Login Details For Agency'])->extraFrom('3')->btn([
		// 						//'action'=>"\\B\\MAS\\Controller@addCCPost",
		// 						'color'=>"btn-success",
		// 						'icon'=>"fa fa-floppy-o",
		// 						'text'=>"Save"
		// 					]);
	\MS\Core\Helper\Comman::DB_flush();

		return $build->view();
	}


	public function taskAddPost(R\AddTask $r){



		
			\MS\Core\Helper\Comman::DB_flush();

			$input=$r->input();
			//dd($input);
			$model=new Model(0);
			if(array_key_exists('UniqId', $input)){

				$uniqid=$input['UniqId'];

			}else{$uniqid=Base::genUniqID();}


			$input['CurrentStatus']='0';

			$input['HasInvoice']='0';
			//$input['InvoiceArray']=collect([])->toJson();

			$input['ReadStatus']=0;
			$input['ReadUserCode']=collect([session('user.userData.UniqId')])->toJson();
			$input['ReadUserArray']=collect(

				[ 
				
				session('user.userData.UniqId')=>
				[ 'UserCode'=>session('user.userData.UniqId'),
				  'Timestamp'=>\Carbon::now()->toDateTimeString(), ]


				])->toJson();


			$data=[
				[
					'id'=>0,
					'code'=>$uniqid
				]
			];


			$model->MS_add($input);

			\MS\Core\Helper\Comman::DB_flush();

			$modelForLCO=new Model('2');


		

			$dataForLCO=[


				'NameOfLCO'=>strtolower($input['NameOfNetwork']),
				'LastNameOfOperator'=>$input['NameOperator'],
				'LastModeoPiracy'=>$input['ModePiracy'],

				'NameOfOperatorArray'=>collect([ [ 'TaskId'=>$uniqid,'NameOfOperator'=>$input['NameOperator']  ]  ])->toJson(),

				'ModeoPiracyArray'=>collect([ [ 'TaskId'=>$uniqid,'ModePiracy'=>$input['ModePiracy']  ]  ])->toJson(),

							];

			$LCOCheck=$modelForLCO->where('NameOfLCO','=',strtolower($input['NameOfNetwork']))->first();
			//dd($modelForLCO->MS_all());
			//dd($LCOCheck);
		//	dd($dataForLCO);

			if($LCOCheck == null)$modelForLCO->MS_add($dataForLCO);
				//dd($modelForLCO);
			\MS\Core\Helper\Comman::DB_flush();
			$modelOfOwner=new Model('3');
			//dd($modelForLCO);

			$dataForOwner=[


				'NameOfOperator'=>strtolower($input['NameOperator']),
				'NameOfOwner'=>$input['NameOwner'],
				'LastModeOfPiracy'=>$input['ModePiracy'],
				'LastStatusOfOperator'=>$input['StatusOperator'],

				'LastModeOfPiracyArray'=>collect([ [ 'TaskId'=>$uniqid,'ModePiracy'=>$input['ModePiracy']  ]  ]),

				'LastStatusOfOperatorArray'=>collect([ [ 'TaskId'=>$uniqid,'StatusOperator'=>$input['StatusOperator']  ]  ]),

							];



			$OwnerCheck=$modelOfOwner->where('NameOfOperator',strtolower($input['NameOperator']))->first();

			if($OwnerCheck == null)$modelOfOwner->MS_add($dataForOwner);



		//	dd(Base::migrate([['id'=>'1','code'=>$uniqid]]));
		//	dd($input);
	
			$returnData=Base::migrate([['id'=>'1','code'=>$uniqid]]);


			//dd($returnData);	
			$rData=		

					[

					'UniqId'=>Base::genUniqID(),

					'TypeOfAction'=>'0',

					'DocumentUploaded'=>false,

					'DocumentArray'=>collect([])->toJson(),

					'DocumentVerified'=>false,

					'DocumentVerifiedArray'=>collect([])->toJson(),

					'VerifiedBy'=>'0',

					'TakenBy'=>session('user.userData.UniqId'),

					];
			//dd($uniqid);

				
			\MS\Core\Helper\Comman::DB_flush();	
			$c4n=\MS\Core\Helper\Comman::random(4);
			\B\NMS\Logics::newNotification(

				session('user.userData.UniqId'),
				1,
				$c4n,
				111,

				' no.'.$uniqid." & assigned to ". \B\AMS\Logics::getAgencyName($input['HireAgencyCode'])." by ".\B\Users\Logics::getUserName(session('user.userData.UniqId')),
				route('NMS.Notification.By.Id',
				
				['UniqId'=>
											\MS\Core\Helper\Comman::en4url($c4n)]),
					route('TMS.Task.View.Id',
				
				['UniqId'=>
											\MS\Core\Helper\Comman::en4url($uniqid)])
				);

			\B\ANMS\Logics::newNotification(
			
							$input['HireAgencyCode'],
							1,
							$c4n,
							111,				
							' no.'.$uniqid,
							route('ANMS.Notification.By.Id',
							
							['UniqId'=>
														\MS\Core\Helper\Comman::en4url($c4n)]),
								route('ATMS.Task.View.Id',
							
							['UniqId'=>
														\MS\Core\Helper\Comman::en4url($uniqid)])
							);




			



				
		
			\MS\Core\Helper\Comman::DB_flush();
			$model2=new Model('1',$input['UniqId']);
			//dd($model2);
			$model2->MS_add($rData,$returnData['id'],$input['UniqId']);
			\MS\Core\Helper\Comman::DB_flush();
			$model3=new \B\AMS\Model();
		//	dd($model3);
			//dd($model3->where('UniqId',$input['HireAgencyCode'])->pluck('AllocatedJobs')->first());
			$agencJobData=[];
			if($model3->where('UniqId',$input['HireAgencyCode'])->pluck('AllocatedJobs')->first()==null){


				$agencJobData[]=$input['UniqId'];
			}else{
				$preData=$model3->where('UniqId',$input['HireAgencyCode'])->pluck('AllocatedJobs')->first();
				//dd($preData);
				$preData=json_decode($preData,true,2);
				if(!in_array($input['UniqId'], $preData)){
								$agencJobData[]=$input['UniqId'];}else{
									$agencJobData=$preData;
								}

			}

			$agencJobData=json_encode($agencJobData,true,2);
			$model3->MS_update(['AllocatedJobs'=>$agencJobData,'UniqId'=>$input['HireAgencyCode'],]);
			$status=200;
			$array=[
					'msg'=>"OK",
			 		'redirectData'=>action('\B\TMS\Controller@indexData'),
			 		
				];

	
		 return response()->json($array, $status);
}




public function taskViewAjax(\Illuminate\Http\Request $r){

	$m=new \B\TMS\Model(7);

	$rData = $r->all();
	//dd($rData );
	if (!array_key_exists('Status', $rData)) $rData['Status'] = 0;

	//return Datatables::of($m->get())->make(true);	
    return \Datatables::of($m->where('Status',$rData['Status'])->get()->map(function ($user){

        $user->HireAgencyCode = \B\AMS\Logics::getAgencyName($user->HireAgencyCode);
        $user->created_at_string=$user->created_at->format("Y/m/d");
        $user->CurrentStatus=\B\TMS\Logics::getTypeOfAction($user->CurrentStatus)['NameOfAction'];

    return $user;
}))->orderByNullsLast()->make(true);



}

public function taskView(\Illuminate\Http\Request $r)
{

	$rData = $r->all();
	$status="Open";
	if (!array_key_exists('Status', $rData)) $rData['Status'] = 0;
	if( $rData['Status']) $status="Closed";



	$data=[

		'title'=>[
					'str'=>"View ".$status." Task",
					'icon'=>"fa fa-recycle fa-90"
				],
		'tableColumn'=>[
			'created_at_string'=>"Created On",
			'UniqId'=>"ID",
			'HireAgencyCode'=>"Assigned Agency",
			'NameOperator'=>'Name of Operator',
			'ModePiracy'=>'Mode of Piracy',
			'CurrentStatus'=>'Current Status',
		],

		'ajax'=>route("TMS.Task.View.Ajax",['Status'=>$rData['Status']]),
	];

	return view("TMS.V.Object.TaskOpenView")->with('data',$data);
    
  
    \MS\Core\Helper\Comman::DB_flush();
    $tableId = 7;
    $data = [
        'sortBy' => 'created_at',
        'paginate' => true,
        'paginate-limit' => 10,
        'sortType' => 'sortByDesc'
    ];
    $title="View All Open Task";
    $build = new \MS\Core\Helper\Builder (__NAMESPACE__);
    if($rData['Status'] == 1) $title="View All Closed Task";
    $build->title($title);
    //

    $model = new Model($tableId);
    //dd($model->where('Status',(boolean)$rData['Status'])->paginate($data['paginate-limit'] ) );
    //dd($model);
    $model = $model->where('Status', "=", $rData['Status'])->orderByDesc($data['sortBy'])->paginate($data['paginate-limit']);
    \MS\Core\Helper\Comman::DB_flush();
    //dd($model);

    $diplayArray = [
        'UniqId' => 'Task ID',

        'HireAgencyCode' => 'Name of Assigned Agency',

        'NameOperator' => 'Name of Operator',

        'IllegalTypeBroadcasting' => 'Type Broadcasting',


        'ModePiracy' => 'Mode of Piracy',
        'NameOfNetwork' => 'LCO/MCO name',
        'created_at' => 'opened on',
        'CurrentStatus' => 'Cur. Status',

    ];

    $link = [

        'delete' => [
            'method' => 'TMS.Task.Delete.Id',
            'key' => 'UniqId',

        ],

        // 'edit'=>[
        // 	'method'=>'AMS.Agency.Edit.Id',
        // 	'key'=>'UniqId',

        // ],


        'view' => [
            'method' => 'TMS.Task.View.Id',
            'key' => 'UniqId',

        ],

        'AllocationLater' => [
            'method' => 'TMS.Task.Gen.Allocation',
            'key' => 'UniqId',
        ],

    ];


    $build->listData($model, $data)->listView($diplayArray);


if($rData['Status'] == 0){
                           $build->btn([
                               'action' => "\\B\\TMS\\Controller@taskAdd",
                               'color' => "btn-info",
                               'icon' => "fa fa-plus",
                               'text' => "Add Task"
                           ])->btn(
                               [
                                   'action' => "\\B\\TMS\\Controller@taskViewByColumn",
                                   'color' => "btn-default",
                                   'icon' => "fa fa-eye",
                                   'text' => "Group By Agency",
                                   'data' => 'HireAgencyCode'
                               ])
                               ->btn(
                                   [
                                       'action' => "\\B\\TMS\\Controller@taskViewByColumn",
                                       'color' => "btn-default",
                                       'icon' => "fa fa-eye",
                                       'text' => "Group By State",
                                       'data' => 'NameOperatorState'
                                   ])
                               ->btn(
                                   [
                                       'action' => "\\B\\TMS\\Controller@taskViewByColumn",
                                       'color' => "btn-default",
                                       'icon' => "fa fa-eye",
                                       'text' => "Group By Month",
                                       'data' => 'created_at'
                                   ]);
                               }


											 $build->addListAction($link)->listGetter(['HireAgencyCode','CurrentStatus','created_at']);
return view('L.Pages.ListWidget');
						return $build->view(true,'list');


}

public function taskViewById($UniqId){

\MS\Core\Helper\Comman::DB_flush();

//dd($UniqId);
		if($UniqId[0] == "_"){

			$uniqId=substr($UniqId, 1);
		}else{

			$uniqId=\MS\Core\Helper\Comman::de4url($UniqId);

		}
		
		//$uniqId=$enUniqId;
		$id=0;






		$m=new \B\TMS\Model();

		
		if($m->where('UniqId',$uniqId)->first()!=null){$rowData=$m->where('UniqId',$uniqId)->first()->toArray();}
		else{$rowData=[];}

		//dd($m)	;

	\MS\Core\Helper\Comman::DB_flush();
			$m1=new \B\TMS\Model();






		if(count($rowData)>0){



			\B\NMS\Logics::readNotificationForAdmin($rowData,$m1);

			




			//\MS\Core\Helper\Comman::DB_flush();
			\MS\Core\Helper\Comman::DB_flush();

			$m2=new Model('1',$rowData['UniqId']);
			$rowData2=$m2->MS_all()->toArray();

//dd($rowData2);
			
			
			\MS\Core\Helper\Comman::DB_flush();
			

		}else{

			$rowData2=[];
		}
		


		$data=[

			'task'=>$rowData,
			'taskDetaisls'=>$rowData2
		];
		//dd($m->where('UniqId',$uniqId)->first());
	//	dd($newsData);

		return view('TMS.V.Object.TaskDetails')->with('data',$data);
}


public function taskViewByIdPdf($UniqId){

\MS\Core\Helper\Comman::DB_flush();

//dd($UniqId);
		if($UniqId[0] == "_"){

			$uniqId=substr($UniqId, 1);
		}else{

			$uniqId=\MS\Core\Helper\Comman::de4url($UniqId);

		}
		
		//$uniqId=$enUniqId;
		$id=0;






		$m=new \B\TMS\Model();

		
		if($m->where('UniqId',$uniqId)->first()!=null){$rowData=$m->where('UniqId',$uniqId)->first()->toArray();}
		else{$rowData=[];}

		//dd($m)	;

	\MS\Core\Helper\Comman::DB_flush();
			$m1=new \B\TMS\Model();






		if(count($rowData)>0){



			\B\NMS\Logics::readNotificationForAdmin($rowData,$m1);

			




			//\MS\Core\Helper\Comman::DB_flush();
			\MS\Core\Helper\Comman::DB_flush();

			$m2=new Model('1',$rowData['UniqId']);
			$rowData2=$m2->MS_all()->toArray();

//dd($rowData2);
			
			
			\MS\Core\Helper\Comman::DB_flush();
			

		}else{

			$rowData2=[];
		}
		


		$data=[

			'data'=>['task'=>$rowData,
						'taskDetaisls'=>$rowData2]
		];
		//dd($m->where('UniqId',$uniqId)->first());
	//	dd($newsData);


		$pdf = \PDF::loadView('TMS.V.Object.TaskDetailsPDF', $data);
		return $pdf->stream();
		return $pdf->download('invoice_'.$rowData['UniqId'].'.pdf');

		return view('TMS.V.Object.TaskDetails')->with('data',$data);
}




public function taskDeleteById($UniqId){
			\MS\Core\Helper\Comman::DB_flush();
			$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);
			$status=200;
			$tableId=0;
			$rData=['UniqId'=>$UniqId];
			

			$m1=new Model($tableId);
			$agencyCode=$m1->where('UniqId',$UniqId)->first()->toArray()['HireAgencyCode'];

			$m2=new \B\AMS\Model ();

			$jobRowData=$m2->where('UniqId',$agencyCode)->pluck('AllocatedJobs')->first();
			if($jobRowData!=null){

				$jobArray=json_decode($m2->where('UniqId',$agencyCode)->pluck('AllocatedJobs')->first(),true);

			}else{
				$jobArray=[];	
			}
			

			if(in_array($UniqId,$jobArray ))unset($jobArray[array_search($UniqId,$jobArray)]);
		//	dd($jobArray );
			if(!count($jobArray)>0)$jobArray=null;

			if($jobArray!=null)$jobArray=json_encode($jobArray,true,3);

			$updatArray=[
				'UniqId'=>$agencyCode,
				'AllocatedJobs'=>$jobArray
			];
			//dd()

			$m2->MS_update($updatArray,0);

			//dd(json_decode($m2->where('UniqId',$agencyCode)->pluck('AllocatedJobs')->first(),true));
			

			$m1->MS_delete($rData,$tableId);

			\Storage::disk('ATMS')->deleteDirectory("Data".DIRECTORY_SEPARATOR.$UniqId);

			
			\MS\Core\Helper\Comman::DB_flush();
			$m3=new Model(1,$UniqId);
			$m3->deleteTable();	


			\MS\Core\Helper\Comman::DB_flush();
	
				$status=200;
			$array=[
					'msg'=>"OK",
			 		'redirectData'=>route('TMS.Task.View'),
			 

				];
				\MS\Core\Helper\Comman::DB_flush();
				//return $this->taskViewById(\MS\Core\Helper\Comman::en4url($UniqId));
	
		// return response()->json($array, $status);
			
		return  $this->taskView();


}

public function taskGenAllocationLatterById($UniqId){



		$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);

		$m1=new \B\AMS\Model ();

	
	$taskCode=$UniqId;

	\MS\Core\Helper\Comman::DB_flush();

	$m2=new \B\TMS\Model ();
	$taskdata=$m2->where('UniqId',$taskCode)->first()->toArray();
	$agencyCode=$taskdata['HireAgencyCode'];
	$data=[

		'agency'=>['name'=>$m1->getHireAgencyCodeFromId($agencyCode)],
		'task'=>$taskdata,

	];


	$data['task']['fullAddress']='Town.District,State';

return view('TMS.V.Pages.allocationLatter')->with('data',$data);
}


public function taskApproveById($UniqId,$StepId){

	\MS\Core\Helper\Comman::DB_flush();
	$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);
	$StepId=\MS\Core\Helper\Comman::de4url($StepId);


	$m1=new Model('1',$UniqId) ;

	$taskArray=[];
	if($m1->where('UniqId',$StepId)->first() != null ){

		$taskArray=$m1->where('UniqId',$StepId)->first()->toArray();

		$documentArray=(array)json_decode($taskArray['DocumentArray'],true,3);

		

		$documentVerifiedArray=(array)json_decode($taskArray['DocumentVerifiedArray'],true,3);
	}

	//dd(session()->all());
	$invoice=[];
	foreach ($documentArray as $key => $value) {
			
			if($value['TypeOfDocument'] =='777' || $value['TypeOfDocument'] == '888' ){


				Logics::inWardInvoice($UniqId,$StepId,$value['UniqId'],$value);
					
			}

		

	}


	//;

	$m1->MS_update( ['DocumentVerifiedArray'=>json_encode($documentArray),'DocumentVerified'=>1,'VerifiedBy'=>session('user.userData.UniqId')] , $StepId ) ;


		\B\TMS\Logics::setCurrentStatusfroEvent($UniqId,'4');



	$status=200;
			$array=[
					'msg'=>"OK",
			 		'redirectData'=>route('TMS.Task.View.Id',['UniqId'=>\MS\Core\Helper\Comman::en4url($UniqId) ]),
			 

				];
				\MS\Core\Helper\Comman::DB_flush();
				return $this->taskViewById(\MS\Core\Helper\Comman::en4url($UniqId));
	
	//	 return response()->json($array, $status);
	




}









            public function getUploadedFile($UniqId,$TaskId,$StepId,$TypeOfDocument,$FileName){


			//dd();
			$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);
			$TaskId=\MS\Core\Helper\Comman::de4url($TaskId);

			$StepId=\MS\Core\Helper\Comman::de4url($StepId);

			$TypeOfDocument=\MS\Core\Helper\Comman::de4url($TypeOfDocument);
			//dd($TypeOfDocument);

			//DIRECTORY_SEPARATOR
			$file=implode('/',['Data',$TaskId,$TypeOfDocument,$FileName]);
			$img=\Storage::disk('ATMS')->get($file);
			
			$responseClass=new \Illuminate\Http\Response($img);


		//	dd($file);
			//dd(\Storage::disk('ATMS')->getDriver()->getAdapter()->getPathPrefix().$file);

			$headers=[
'content-type'=> \Storage::disk('ATMS')->mimeType($file)

			];

	// 		return $responseClass->header('content-type', \Storage::disk('ATMS')->mimeType($file));
	// dd($responseClass->header('content-type', \Storage::disk('ATMS')->mimeType($file)));
	// 		return response()->file(\Storage::disk('ATMS')->getDriver()->getAdapter()->getPathPrefix().$file,[
	// 			'content-type'=> \Storage::disk('ATMS')->mimeType($file)

	// 			]);
			ob_end_clean();
			 return $responseClass->header('content-type', \Storage::disk('ATMS')->mimeType($file))->header('Content-Length', \Storage::disk('ATMS')->size($file));//->header('Content-Disposition','attachment; filename=' . $FileName);



			}


			public function riseQuery($TaskId,$StepId,$en=true){


			\MS\Core\Helper\Comman::DB_flush();
			$status=200;
			$array=[
					'msg'=>"OK",
			 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
			 		
				];

	
		 
							
			   if($en){
			    $data['TaskId']=\MS\Core\Helper\Comman::de4url($TaskId);
				$data['StepId']=\MS\Core\Helper\Comman::de4url($StepId);
			    }else{
			    $data['TaskId']=$TaskId;
				$data['StepId']=$StepId;
			    }
			$m1=new Model();


			if($m1->where('UniqId',$data['TaskId'])->first()->toArray() ==null){

					$status=422;
			$array=[
					'msg'=>["Task Not Found"],
			 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
			 		
				];

	
				return response()->json($array, $status);


			}
			$data['taskData']=$m1->where('UniqId',$data['TaskId'])->first()->toArray();

			\MS\Core\Helper\Comman::DB_flush();
			$m2=new Model('1',$data['TaskId']) ;
			
			if($m2->where('UniqId',$data['StepId'])->first() ==null){

					$status=422;
			$array=[
					'msg'=>["Task's Step Details Not Found"],
			 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
			 		
				];

	
				return response()->json($array, $status);


			}

			$data['stepData']=$m2->where('UniqId',$data['StepId'])->first()->toArray();

			$data['stepData']['DocumentArray']=(array)json_decode($data['stepData']['DocumentArray'],true);
			$data['stepData']['DocumentVerifiedArray']=(array)json_decode($data['stepData']['DocumentVerifiedArray'],true);
			$data['stepData']['DocumentRejectedArray']=(array)json_decode($data['stepData']['DocumentRejectedArray'],true);

			$data['stepData']['DocumentQueryArray']=(array)json_decode($data['stepData']['DocumentQueryArray'],true);
			$data['stepData']['DocumentReplyArray']=(array)json_decode($data['stepData']['DocumentReplyArray'],true);



			



		//	dd($data);

			return view('TMS.V.Object.TaskQueryRise')->with('data',$data);






			}



            public function riseQueryPost ( R\RiseQuery $r, $TaskId,$StepId){

				\MS\Core\Helper\Comman::DB_flush();

				$input=$r->all();

				

				//dd($input);
				$data['TaskId']=\MS\Core\Helper\Comman::de4url($TaskId);
				$data['StepId']=\MS\Core\Helper\Comman::de4url($StepId);


	$m1=new Model(1,$data['TaskId']);


foreach ($input['SelectedFiles'] as $task => $files) {
			
			
			//dd($m1->where('UniqId',$task)->first()==null);

			if($m1->where('UniqId',$task)->first() ==null){
					$status=422;
			$array=[
					'msg'=>["Task Not Found"],
			 				 		
				];

	
				return response()->json($array, $status);


			}

			foreach ($files as $step => $file) {
			
			\MS\Core\Helper\Comman::DB_flush();

				if(array_key_exists('taskData', $data)){
	
							if(!array_key_exists($task, $data['taskData']) ){

											$data['taskData'][$task]=$m1->where('UniqId',$task)->first()->toArray();
										}

									}else{

											$data['taskData'][$task]=$m1->where('UniqId',$task)->first()->toArray();

										}
			


			}



			//dd($data);
		
			

			\MS\Core\Helper\Comman::DB_flush();


			$data['taskData'][$task]['DocumentArray']=(array)json_decode($data['taskData'][$task]['DocumentArray'],true);
			$data['taskData'][$task]['DocumentVerifiedArray']=(array)json_decode($data['taskData'][$task]['DocumentVerifiedArray'],true);

			$data['taskData'][$task]['DocumentQueryArray']=(array)json_decode($data['taskData'][$task]['DocumentQueryArray'],true);
			$data['taskData'][$task]['DocumentReplyArray']=(array)json_decode($data['taskData'][$task]['DocumentReplyArray'],true);






}

//dd($data);





foreach ($data['taskData']as $key => $value) {
	

				foreach ($value['DocumentArray']as $key1 => $value1) {

		


						//dd($input['SelectedFiles']);


						//var_dump(array_key_exists($value1['UniqId'], $input['SelectedFiles'][$key]));

							//dd($input['SelectedFiles'][$key]);

						//	dd($value1);}
						if(array_key_exists($value1['UniqId'], $input['SelectedFiles'][$key])){

									//	if(	)
						$value1['FileName']=$key1;
							//$selectedFile[$value1['UniqId']]=$value1;

						

						$QueryNo=Base::genUniqID();

						$QueryData[$key][$value1['UniqId']]=	[

						$QueryNo=>[
						'Query'=>$input['SelectedFilesQuery'][$key][$value1['UniqId']]['query'],
						'Replay'=>null,
						'QueryStatus'=>0,
						//'QueryDocumentArray'=>$selectedFile

						],



						];
							$QueryData[$key][$value1['UniqId']][$QueryNo]['QueryDocumentArray'][]=$value1;
							
						}
			



				}

			
if(array_key_exists($key, $input['SelectedFiles'])){


	//if(array_key_exists($key, $data['taskData'][$key]['DocumentQueryArray']))

	//dd($data['taskData'][$key]['DocumentQueryArray']);

	//dd($QueryData+$data['taskData'][$key]['DocumentQueryArray']);
	//$DocumentQueryArray=[];
	
				if(count($data['taskData'][$key]['DocumentQueryArray']) > 0){
				
					//dd($QueryData+$data['taskData'][$key]['DocumentQueryArray']);

					$DocumentQueryArray=$QueryData[$key]+$data['taskData'][$key]['DocumentQueryArray'];
				//$DocumentQueryArray=collect($QueryData+$data['taskData'][$key]['DocumentQueryArray'])->toJson();	
			}else{

				$DocumentQueryArray=$QueryData[$key];
			//	$DocumentQueryArray=collect($QueryData)->toJson();
			}
				
			$DocumentQueryArray=collect($DocumentQueryArray)->toJson();

		// echo "<pre>";

		// 			var_dump($DocumentQueryArray);


				
			
		//	dd($key);

				
				$updateArray[$key][$value1['UniqId']]=[
			
					'DocumentQuery'=>1,
					'DocumentQueryArray'=>$DocumentQueryArray,
					'QueryRisedBy'=>session('user.userData.uniqId'),
			
					];	


}else{

	$updateArray=null;
}
				
//dd($input);


}


//dd($updateArray);

foreach ($updateArray as $key2 => $value2) {




		foreach ($value2 as $key3=> $value3) {

			//dd($value3);
	       // dd($value3['DocumentQueryArray']);
			//dd(json_decode($value3['DocumentQueryArray'],true));
			\MS\Core\Helper\Comman::DB_flush();
			$m2=new Model('1',$data['TaskId']);

			$m2->MS_update($value3,$key2);
			\MS\Core\Helper\Comman::DB_flush();
			$m3=new Model();
			$dataFornotiFy=$m3->where('UniqId',$data['TaskId'])->first()->toArray();
			
			//dd( $data['taskData'][$key2] );
				$c4n=\MS\Core\Helper\Comman::random(4);
			\B\ANMS\Logics::newNotification(

				$dataFornotiFy['HireAgencyCode'],
				1,
				$c4n,
				333,				
				' For Task No.'.$data['TaskId']." on Step No.".$key2,
				route('ANMS.Notification.By.Id',
				
				['UniqId'=>
											\MS\Core\Helper\Comman::en4url($c4n)]),
					route('ATMS.Task.Rise.Step.Replay',
				
				['TaskId'=>
											\MS\Core\Helper\Comman::en4url($data['TaskId']),
				'StepId'=>
											\MS\Core\Helper\Comman::en4url($key2)]
											)
				);


		}
			
}



		\B\TMS\Logics::setCurrentStatusfroEvent($data['TaskId'],'5');


			\MS\Core\Helper\Comman::DB_flush();	
			$c4n=\MS\Core\Helper\Comman::random(4);
			\B\NMS\Logics::newNotification(

				session('user.userData.UniqId'),
				1,
				$c4n,
				333,				
				' For Task No.'.$data['TaskId'],
				route('NMS.Notification.By.Id',
				
				['UniqId'=>
											\MS\Core\Helper\Comman::en4url($c4n)]),
					route('TMS.Task.Rise.Step.Query.View',
				
				['TaskId'=>
											\MS\Core\Helper\Comman::en4url($data['TaskId']),
				'StepId'=>
											\MS\Core\Helper\Comman::en4url($data['StepId'])]
											)
				);






//dd($updateArray);

			$status=200;
			$array=[
					'msg'=>"OK",
			 		'redirectData'=>route('TMS.Task.View.Id',['UniqId'=>\MS\Core\Helper\Comman::en4url($data['TaskId']) ]),
			 		//'data'=>$input,
			 	//	'array'=>$return

				];

	
		 return response()->json($array, $status);

		//	return $this->taskViewById(\MS\Core\Helper\Comman::en4url());
				//dd();
				




			}



	        public function  riseQueryView ($TaskId,$StepId){

		        \MS\Core\Helper\Comman::DB_flush();
				$data['TaskId']=\MS\Core\Helper\Comman::de4url($TaskId);
				$data['StepId']=\MS\Core\Helper\Comman::de4url($StepId);
					$m1=new Model();


			if($m1->where('UniqId',$data['TaskId'])->first()->toArray() ==null){

					$status=422;
			$array=[
					'msg'=>["Task Not Found"],
			 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
			 		
				];

	
				return response()->json($array, $status);


			}
			$data['taskData']=$m1->where('UniqId',$data['TaskId'])->first()->toArray();

			\MS\Core\Helper\Comman::DB_flush();
			$m2=new Model('1',$data['TaskId']) ;
			
			if($m2->where('UniqId',$data['StepId'])->first() ==null){

					$status=422;
			$array=[
					'msg'=>["Task's Step Details Not Found"],
			 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
			 		
				];

	
				return response()->json($array, $status);


			}

			$data['stepData']=$m2->where('UniqId',$data['StepId'])->first()->toArray();
			$data['stepData']['DocumentArray']=(array)json_decode($data['stepData']['DocumentArray'],true);
			$data['stepData']['DocumentVerifiedArray']=(array)json_decode($data['stepData']['DocumentVerifiedArray'],true);
			$data['stepData']['DocumentRejectedArray']=(array)json_decode($data['stepData']['DocumentRejectedArray'],true);

			$data['stepData']['DocumentQueryArray']=(array)json_decode($data['stepData']['DocumentQueryArray'],true);
			$data['stepData']['DocumentReplyArray']=(array)json_decode($data['stepData']['DocumentReplyArray'],true);


			

		//	dd($data);


			return view('TMS.V.Object.TaskApprove')->with('data',$data);

				



	}



	        public function  riseQueryReject($TaskId,$StepId,$en=true){


			    \MS\Core\Helper\Comman::DB_flush();
			    \B\TMS\Logics::setCurrentStatusfroEvent($UniqId,'9');
			    if($en){
			    $data['TaskId']=\MS\Core\Helper\Comman::de4url($TaskId);
				$data['StepId']=\MS\Core\Helper\Comman::de4url($StepId);
			    }else{
			    $data['TaskId']=$TaskId;
				$data['StepId']=$StepId;
			    }
				
\MS\Core\Helper\Comman::DB_flush();
					$m1=new Model();


			if($m1->where('UniqId',$data['TaskId'])->first()->toArray() ==null){

					$status=422;
			$array=[
					'msg'=>["Task Not Found"],
			 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
			 		
				];

	
				return response()->json($array, $status);


			}
			$data['taskData']=$m1->where('UniqId',$data['TaskId'])->first()->toArray();

			\MS\Core\Helper\Comman::DB_flush();
			$m2=new Model('1',$data['TaskId']) ;
			
			if($m2->where('UniqId',$data['StepId'])->first() ==null){

					$status=422;
			$array=[
					'msg'=>["Task's Step Details Not Found"],
			 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
			 		
				];



	
				return response()->json($array, $status);


			}

			$data['stepData']=$m2->where('UniqId',$data['StepId'])->first()->toArray();
			$data['stepData']['DocumentArray']=(array)json_decode($data['stepData']['DocumentArray'],true);
			$data['stepData']['DocumentVerifiedArray']=(array)json_decode($data['stepData']['DocumentVerifiedArray'],true);

			$data['stepData']['DocumentQueryArray']=(array)json_decode($data['stepData']['DocumentQueryArray'],true);
			$data['stepData']['DocumentReplyArray']=(array)json_decode($data['stepData']['DocumentReplyArray'],true);
			//dd($m2);
			$m2->MS_update(['DocumentVerified'=>'3,','VerifiedBy'=>session('user.userData.UniqId')],$data['StepId']);
			
			$status=200;
			$array=[
					'msg'=>"OK",
			 		'redirectData'=>route('TMS.Task.View.Id',['UniqId'=>\MS\Core\Helper\Comman::en4url($data['TaskId']) ]),
			 				];
			return $this->taskViewById(\MS\Core\Helper\Comman::en4url($data['TaskId']));
	
		 return response()->json($array, $status);
			//dd($data);

	}


        	public function taskViewByColumn ($Column){



		return view('TMS.V.Object.TaskList')->with('data',['columnName'=>$Column]);



	}




        	public function riseQueryforTask ($TaskId){

		\MS\Core\Helper\Comman::DB_flush();
		$data['TaskId']=\MS\Core\Helper\Comman::de4url($TaskId);
		$m1=new Model(1,$data['TaskId']);
		//dd($m1->get()->last()->toArray());

		if($m1->get()->last() ==null){

					$status=422;
					$array=[
							'msg'=>["Task Not Found"],
					 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
					 		
						];

	
				return response()->json($array, $status);


			}
			$data['taskData']=$m1->get()->last()->toArray();
			
			return $this->riseQuery($data['TaskId'],$data['taskData']['UniqId'],false);

			//dd($data);




	}


        	public function riseQueryActionPost(\Illuminate\Http\Request $r, $TaskId){

		$data['TaskId']=\MS\Core\Helper\Comman::de4url($TaskId);
		$input=$r->all();
		//dd($r->all());

		$action=[];
		foreach ($input['SelectedFiles'] as $stepId => $fileArray) {
					
					\MS\Core\Helper\Comman::DB_flush();
					$m1=new \B\TMS\Model(1,$data['TaskId']);

					

				foreach ($fileArray as $fileId => $fileAction) {
				

					//$lvl1=
					
					//dd($fileAction);
					switch ($fileAction) {
						case '2':
						//$action[$taskId][$fileId]=$fileAction;
							break;

						case '1':
								$action[$fileAction][$stepId][$fileId]=$fileAction;
							break;
						case '0':
								$action[$fileAction][$stepId][$fileId]=$fileAction;
							break;

						default:
							# code...
							break;
					}
				}


			//dd($fileId);



		}
//dd($action);

		foreach ($action as $actions => $taskArray) {
			


			foreach ($taskArray as $stepId => $stepArray) {
			
				foreach ($stepArray as $fileId => $fileAction) {


					Logics::takeActionOnFileById($data['TaskId'],$stepId,$fileId,$fileAction);

					//dd($fileId);
				}

				

			

			}


		}
		$status=200;
			$array=[
					'msg'=>"OK",
			 		'redirectData'=>route('TMS.Task.View.Id',['UniqId'=>\MS\Core\Helper\Comman::en4url($data['TaskId']) ]),
			 				];
			 				return response()->json($array, $status);

		return $this->taskViewById(\MS\Core\Helper\Comman::en4url($data['TaskId']));


	}


	        public function searchTask(){

			$data=[];
			return view('TMS.V.Object.TaskSearch')->with('data',$data);
	}


	        public function searchTaskPost(\Illuminate\Http\Request $r){

		$input=$r->all();
		//dd($input);



		switch ($input['TypeOfSearch']) {

			case '0':
				\MS\Core\Helper\Comman::DB_flush();
				$searchText=\B\AMS\Logics::getAgancyCode($input['QueryText']);
				//dd();
				\MS\Core\Helper\Comman::DB_flush();
				$m=new \B\TMS\Model(7);
				$model=$m->where('HireAgencyCode' ,$searchText )->paginate(999);
				//	dd();

		
				break;
			case '1':
				\MS\Core\Helper\Comman::DB_flush();
				$CurrentStatus=Logics::getStatusCodeFromActionName($input['QueryText']);
				
				\MS\Core\Helper\Comman::DB_flush();
				$m=new \B\TMS\Model(7);
				$model=$m->where('CurrentStatus' ,$CurrentStatus )->paginate(999);
				//	dd();

							//dd( );

			
				break;


		case '2':
				\MS\Core\Helper\Comman::DB_flush();
				$searchText=$input['QueryText'];
				
				\MS\Core\Helper\Comman::DB_flush();
				$m=new \B\TMS\Model(7);
				$model=$m->where('NameOperatorState' ,$searchText )->paginate(999);
				//	dd();

		
				break;
			

		case '3':
				\MS\Core\Helper\Comman::DB_flush();
				$searchText=$input['QueryText'];
				$dt = \Carbon::parse($searchText);
				//dd(\Carbon::parse(explode(",",$searchText)[0])->month);
				$month=\Carbon::parse(explode(",",$searchText)[0])->month;
				$year=explode(",",$searchText)[1];
				//dd($year);
				\MS\Core\Helper\Comman::DB_flush();
				$m=new \B\TMS\Model(7);
				//dd($m);

		
			    //dd($m->whereYear('created_at',(string) $dt->year)->get()->toArray());
				$model=$m->whereYear('created_at',(string) $year)->whereMonth('created_at',(string)$month)->paginate(999);
				//	dd();

		
				break;

			default:
					$status=422;
			$array=[
					'msg'=>"NOOK",
			 		'Data'=>null];
			

				break;
		}



				\MS\Core\Helper\Comman::DB_flush();

		$build=new \MS\Core\Helper\Builder (__NAMESPACE__);

			\MS\Core\Helper\Comman::DB_flush();
	//	dd($model);

						$diplayArray=[
				//'UniqId'=>'ID',

				'HireAgencyCode'=>'Name of Assigned Agency',

				'NameOperator'=>'Name of Operator',

				'IllegalTypeBroadcasting'=>'Type Broadcasting',
				

				'ModePiracy'=>'Mode of Piracy',
				'NameOfNetwork'=>'LCO/MCO name',

				'CurrentStatus'=>'Cur. Status',

						]


						;
								$link=[

					'view'=>[
						'method'=>'TMS.Task.View.Id',
						'key'=>'UniqId',

					],

			
				];




						$build->listData($model)->listView($diplayArray)->addListAction($link)->listGetter(['HireAgencyCode','CurrentStatus']);	


			$status=200;
			$array=[
					'msg'=>"OK",
			 		'Data'=>$build->view(true,'list')->render(),
			 				];
			 				return response()->json($array, $status);



	}



	        public function taskUploadById($UniqId){

		$uniqId=\MS\Core\Helper\Comman::de4url($UniqId);

		$id=8;
		\MS\Core\Helper\Comman::DB_flush();
		$build=new \MS\Core\Helper\Builder (__NAMESPACE__);
		\MS\Core\Helper\Comman::DB_flush();
		$build->title("Upload Document For Task No.".$uniqId)->action("taskUploadByIdPost",\MS\Core\Helper\Comman::en4url($uniqId))->btn([
								'action'=>"\\B\\TMS\\Controller@taskViewById",
								'action-para'=>\MS\Core\Helper\Comman::en4url($uniqId),
								'color'=>"btn-info",
								'icon'=>"fa fa-fast-backward",
								'text'=>"Back to Task Overview"
							])->btn([
								//'action'=>"\\B\\MAS\\Controller@addCCPost",
								'color'=>"btn-success",
								'icon'=>"fa fa-floppy-o",
								'text'=>"Upload"
							])->js(["Core.js.Backend.Multiple","ATMS.J.UploadDocument"])->extraFrom($id,['title'=>'Attachments','multiple'=>true,'multipleAdd'=>true]);

		//dd($build);
		\MS\Core\Helper\Comman::DB_flush();
		return $build->view();

	}



	        public function taskUploadByIdPost($UniqId,\B\ATMS\R\UploadDocuments $r){


		return Logics::uploadDocument($UniqId,$r);




	}


	        public function taskStepDeleteById($TaskId,$StepId){


		return Logics::deleteStep($TaskId,$StepId);



	}



            public function taskCloseById($UniqId){
			\MS\Core\Helper\Comman::DB_flush();
			$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);
			$status=200;
			$tableId=7;
			$ActionType='9';//Closed & to be data Uploaded to Star

			$m=new Model($tableId);

			$data=$m->where('UniqId',$UniqId)->get();
			//dd($data->count());
			if($data->count()){

				$data=$data->first();
				if($data['Status']!=1)$m->MS_update(['Status'=>1],$UniqId);
				



			}
			$status=422;
			$array=[
					'msg'=>"OK",
			 		'redirectData'=>route('TMS.Task.View'),
					'uniqid'=>	$UniqId,		 
					'data'=>$data
				];

				


				if($data['Status']!=1)Logics::TaskNotify($UniqId,$data['HireAgencyCode'],'666');
				
				Logics::closeEntryToDB($UniqId);
				Logics::setCurrentStatusfroEvent($UniqId,$ActionType);
				\MS\Core\Helper\Comman::DB_flush();
				return $this->taskViewById(\MS\Core\Helper\Comman::en4url($UniqId));
				
		}



        	public  function taskAddPaymentModelbyId($UniqId){

		$status="200";

		$array=[

			'redirectModelData'=>route('TMS.Task.View')

		];	

		return response()->json($array,$status);




	}




        	public function taskAddPaymentbyId($UniqId){


		$uniqId=\MS\Core\Helper\Comman::de4url($UniqId);

		$data=[
			'TaskId'=>$uniqId,
		];
		return view("TMS.V.Object.GenrateInvoice")->with('data',$data);
		$id=12;
		\MS\Core\Helper\Comman::DB_flush();
		$build=new \MS\Core\Helper\Builder (__NAMESPACE__);
		\MS\Core\Helper\Comman::DB_flush();
		$build->title("Genrate Invoice For Task No.".$uniqId)->action("taskUploadByIdPost",\MS\Core\Helper\Comman::en4url($uniqId))->btn([
								'action'=>"\\B\\TMS\\Controller@taskViewById",
								'action-para'=>\MS\Core\Helper\Comman::en4url($uniqId),
								'color'=>"btn-info",
								'icon'=>"fa fa-fast-backward",
								'text'=>"Back to Task Overview"
							])->btn([
								//'action'=>"\\B\\MAS\\Controller@addCCPost",
								'color'=>"btn-success",
								'icon'=>"fa fa-floppy-o",
								'text'=>"Upload"
							])->js(["Core.js.Backend.Multiple","ATMS.J.UploadDocument"])->extraFrom($id,['title'=>'Attachments','multiple'=>true,'multipleAdd'=>true]);

		//dd($build);
		\MS\Core\Helper\Comman::DB_flush();
		return $build->view();



	}

        	public function taskAddInvoicebyIdPost($TaskId,R\AddInvoice $r){

		$TaskId=\MS\Core\Helper\Comman::de4url($TaskId);
		
		Logics::CreateInvoice($TaskId,$r->all());



			$status="200";

		$array=[

			'redirectModData'=>route('TMS.Task.View.Id',['UniqId'=>\MS\Core\Helper\Comman::en4url($TaskId)])

		];	

		return response()->json($array,$status);

		//\MS\Core\Helper\Comman::DB_flush();
		//return $this->taskViewById(\MS\Core\Helper\Comman::en4url($TaskId));

	
	}

}



