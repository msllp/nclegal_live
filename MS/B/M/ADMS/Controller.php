<?php
namespace B\ADMS;

class Controller extends \App\Http\Controllers\Controller
{
	public function __construct(){

        $this->middleware('backend');

    }
	public function index(){




			$data=[

			

			];
		return view('ADMS.V.panel_data')->with('data',$data);
		
		
	}


	public function indexData(){




			$data=[

			

			];
		return view('ADMS.V.Object.MasterDetails')->with('data',$data);
		
		
	}

	public function viewAllTypeOfDocuments(){
				$tableId=2;

		$build=new \MS\Core\Helper\Builder ('B\ADMS');

		$model=new Model($tableId);

	$model=$model->where('id',">",0);
	
	$model=$model->paginate(500);
	//	dd($model);

						$diplayArray=[


				'UniqId'=>'Document Type ID',



				'NameOfDocuments'=>'Name of Type of Document',


						];

						$link=[

			// 'delete'=>[
			// 	'method'=>'AMS.Agency.Delete.Id',
			// 	'key'=>'UniqId',

			// ],

			'edit'=>[
				'method'=>'ADMS.TypeOfDocument.Edit.Id',
				'key'=>'UniqId',

			],


			// 'view'=>[
			// 	'method'=>'ATMS.Task.View.Id',
			// 	'key'=>'UniqId',

			// ],

		];


			$data=[

		'paginate'=>true,
		"paginate-limit"=>10,
		];



						$build-> 
						title("Manage Type of Documents")->
						listData($model,$data)->listView($diplayArray)
						->btn([
						 						'action'=>"\\B\\ADMS\\Controller@addDocumentType",
						 						'color'=>"btn-info",
						 						'icon'=>"fa fa-plus",
						 						'text'=>"Add Type of Document"
						 					])
						->addListAction($link)
						;	

				///	dd($build);


					return  $build->view(true,'list');


	}




    public function addDocumentType(){




        \MS\Core\Helper\Comman::DB_flush();
        $form=new \MS\Core\Helper\Builder( __NAMESPACE__ );
        $form
            ->title('Add New Type of Document')
            ->content(3)
            ->btn([
                'action'=>"\\B\\ADMS\\Controller@viewAllTypeOfDocuments",
                'color'=>"btn-info",
                'icon'=>"fa fa-fast-backward",
                'text'=>"Back"
            ])
            ->btn([
                //  'action'=>"\\B\\ADMS\\Controller@viewAllTypeOfDocuments",
                //'action-para'=>\MS\Core\Helper\Comman::en4url($uniqId),
                'color'=>"btn-success",
                'icon'=>"fa fa-save",
                'text'=>"Save"
            ])
        ;

        return $form->view();
    }


    public function addDocumentTypePost(R\DocumentTypeAdd $r){


        $status=200;
        $rData=$r->all();
        $id=2;

        \MS\Core\Helper\Comman::DB_flush();
        $model=new Model($id);
        $model->MS_add($rData);

        $array=[
            'msg'=>"OK",
            'redirectData'=>action('\B\ADMS\Controller@viewAllTypeOfDocuments'),

        ];

        return response()->json($array, $status);


    }



	public function editDocumentType($UniqId){



		$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);

		\MS\Core\Helper\Comman::DB_flush();
		$m=new \B\ADMS\Model (2);
		$data=$m->where('UniqId',$UniqId)->first()->toArray();
		//dd();


		\MS\Core\Helper\Comman::DB_flush();
		$form=new \MS\Core\Helper\Builder( __NAMESPACE__ );
		$form
		->title('Edit Type of Documents :'. $UniqId)
		->content(3,$data)
		->btn([
								'action'=>"\\B\\ADMS\\Controller@viewAllTypeOfDocuments",
								//'action-para'=>\MS\Core\Helper\Comman::en4url($uniqId),
								'color'=>"btn-info",
								'icon'=>"fa fa-fast-backward",
								'text'=>"Back"
							])
            ->btn([
              //  'action'=>"\\B\\ADMS\\Controller@viewAllTypeOfDocuments",
                //'action-para'=>\MS\Core\Helper\Comman::en4url($uniqId),
                'color'=>"btn-success",
                'icon'=>"fa fa-save",
                'text'=>"Save"
            ])
		;

		return $form->view();
	}

	public function editDocumentTypePost( R\DocumentTypeEdit $r,$UniqId){

        $UniqId=\MS\Core\Helper\Comman::de4url($UniqId);
        $status=200;
        $rData=$r->all();
        $id=2;


        $model=new Model($id);
        $model->MS_update($rData,$UniqId);

        $array=[
            'msg'=>"OK",
            'redirectData'=>action('\B\ADMS\Controller@viewAllTypeOfDocuments'),

        ];

        return response()->json($array, $status);


    }

    public function getAllAgentsBills(){

    return view("ADMS.V.Object.SearchAgent");



    }

    public function searchAgentBillData(\Illuminate\Http\Request $r){

        $input=$r->all();
        //dd($r->all());

        if(array_key_exists('TypeOfSearch' ,$input)) {


            switch ($input['TypeOfSearch']) {
                case '0':
                    \MS\Core\Helper\Comman::DB_flush();
                    $m2=new \B\AMS\Model();

                    $allAganecyData=$m2->MS_all()->pluck('Name','UniqId')->toArray();
                    $allAganecyDataRaw=$m2->MS_all()->groupBy('UniqId')->toArray();
                    //dd($allAganecyDataRaw);
                    $Agenctdata=[];

                    $m3=new \B\ADMS\Model(1);
                    $allIBillTable=array_flip(\DB::connection($m3->getConnectionName())->getDoctrineSchemaManager()->listTableNames());

                    foreach ($allIBillTable as $key=>$value){

                        $tableExo=explode('_',$key);

                        if(!array_key_exists($tableExo[2],$Agenctdata))$Agenctdata[$tableExo[2]]=$allAganecyData[$tableExo[2]];






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


    public function searchAgentBill( \Illuminate\Http\Request $r  ){

        $input=$r->all();


        if(array_key_exists('TypeOfSearch' ,$input)) {


            switch ($input['TypeOfSearch']) {


                case '0':
                    \MS\Core\Helper\Comman::DB_flush();
                    $AgencyCode=$input['QueryText'];

                    //\B\AAMS\F\SearchTrips::byTaskId($TaskCode);
                    $status=200;
                    $array=[
                        'Data'=>\B\ADMS\F\SearchBill::byAgencyCode($AgencyCode),
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
    }


        public function searchAgentBill_2( \Illuminate\Http\Request $r  ){

            dd($r->all());

        }

    public function getDocument($LedgerId,$fileId){
        $data['LedgerId']=\MS\Core\Helper\Comman::de4url($LedgerId);
        $data['fileId']=\MS\Core\Helper\Comman::de4url($fileId);
        \MS\Core\Helper\Comman::DB_flush();
        $m1=new Model(1,$data['LedgerId']);
        $fileDetails=$m1->where('UniqId',$data['fileId']) ->first()->toArray();
        $img=\Storage::disk('ADMS')->get($fileDetails['Path']);

        $responseClass=new \Illuminate\Http\Response($img);


        ob_end_clean();
        return $responseClass->header('content-type', \Storage::disk('ADMS')->mimeType($fileDetails['Path']))->header('Content-Length', \Storage::disk('ADMS')->size($fileDetails['Path']));//->header('Content-Disposition','attachment; filename=' . $FileName);
  }



}