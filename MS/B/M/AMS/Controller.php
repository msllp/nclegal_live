<?php
namespace B\AMS;
use Illuminate\Http\Request;
class Controller extends \App\Http\Controllers\Controller
{
	public function __construct(){
     
		$this->middleware('backend')->except(['hookAgencyLoginPost']);
        //$this->middleware('groupname')->except(['method_name']);
    }
	public function index(){
		//dd(session()->all());

		//dd(\Carbon::now()->toDateTimeString());


		// for ($i=0; $i < 200; $i++) { 

		// 	\MS\Core\Helper\DBFeeder::CreateAgenecgy();
		//  \MS\Core\Helper\DBFeeder::CreateTask();
		// 	# code...
		// }



		


			$data=[

			

			];


	
		return view('AMS.V.panel_data')->with('data',$data);
		
		
	}


	public function indexData(){




			$data=[

			

			];
		return view('AMS.V.Object.MasterDetails')->with('data',$data);
		
		
	}



	public function hookAgencyLoginPost(R\LoginAgency $r){


		
		//dd($psw);
		$input=$r->input();

		$model=new Model();

		$row=$model->where('Username',$input['UserName']);


		if($row->first()!=null){


	     $psw=\MS\Core\Helper\Comman::de($row->pluck('Password')->first(), ENCRYPTION_KEY);
	    //$name=$row->pluck('FirstName')->first()." ".$row->pluck('LastName')->first();
	    $agency=[];

	    
	    //dd($psw == $input['Password']);
	    if($psw == $input['Password']){

	    $id=$row->pluck('id');
	   
	   // dd($psw);
	    $agency['number']=$row->pluck('AttConatctNo')->first();
	    $agency['email']=$row->pluck('AttConatctNo')->first();
		$agency['name']=$row->pluck('Name')->first();
		$agency['jobs']=json_decode($row->pluck('AllocatedJobs')->first(),true,10);
		$agency['UniqId']=$row->pluck('UniqId')->first();


		$status=200;
			$array=[
					'redirect'=>route('APanel.Index'),	

				];
		
		   session()->put(['user' => [
	       
	        'id'=>$id->first(),
	        'userData'=>$agency,
	        'SuperAdmin'=>0,
	        'AgencyAdmin'=>1,
	        'UniqId'=>$row->pluck('UniqId')->first(),
	        
	        ] ]);

	
		//  return redirect()->action("\B\APanel\Controller@index");
				//return redirect()->action("\B\APanel\Controller@index");
		

	    }else{
			$status=422;
			$array=[
					'msg'=>[
					'Password is not valid.',
						

					],

					

				];

	    }

	

		}

		

	
		 return response()->json($array, $status);
		//exit();


	}




	function agencyAdd(){
//Base::migrate([['id'=>'0']]);
	

			$id=1;
		$build=new \MS\Core\Helper\Builder (__NAMESPACE__);

		$build->title("Add Agency")->heading(['Basic Details of Agency'])->content($id)->action("agencyAdd")->btn([
								'action'=>"\\B\\AMS\\Controller@indexData",
								'color'=>"btn-info",
								'icon'=>"fa fa-fast-backward",
								'text'=>"Back"
							])->heading(['Conern Person Details'])->extraFrom('2')->heading(['Login Details For Agency'])->extraFrom('3')->btn([
								//'action'=>"\\B\\MAS\\Controller@addCCPost",
								'color'=>"btn-success",
								'icon'=>"fa fa-floppy-o",
								'text'=>"Save"
							]);


		return $build->view();
	}



	public function agencyAddPost(R\AddAgency $r){



			$status=200;
			$tableId=0;
			$rData=$r->all();
			
			//dd($rData);
			if(array_key_exists('ConfirmPassword', $rData))unset( $rData['ConfirmPassword']);
			if(array_key_exists('Password', $rData))$rData['Password']=\MS\Core\Helper\Comman::en($rData['Password']);



			$model=new Model($tableId);
			$return=$model->MS_add($rData,$tableId);



				\B\ANMS\Base::migrate([ 
					[
					'id'=>1,
					'code'=>$rData['UniqId']
					]
							]);


				\B\AAMS\Base::migrate([ 
					[
					'id'=>3,
					'code'=>$rData['UniqId']
					]
							]);
	



			$array=[
					'msg'=>"OK",
			 		'redirectData'=>action('\B\AMS\Controller@indexData'),
			 		//'data'=>$input,
			 		'array'=>$return

				];

	
		 return response()->json($array, $status);


	}


	public function agencyView(){


				$tableId=0;

		$build=new \MS\Core\Helper\Builder (__NAMESPACE__);
		$build->title("View All Agency");
	//	

		$model=new Model($tableId);
		$model=$model->paginate($tableId);
	//	dd($model);

						$diplayArray=[
				//'UniqId'=>'ID',

				'Name'=>'Name',


				//'NewsDate'=>'Date',

				'City'=>'City',

				'State'=>'State',
				

				'Username'=>'Agency ID',


				'Status'=>'Cur. Status',

						];

						$link=[

			'delete'=>[
				'method'=>'AMS.Agency.Delete.Id',
				'key'=>'UniqId',

			],

			'edit'=>[
				'method'=>'AMS.Agency.Edit.Id',
				'key'=>'UniqId',

			],


			'LoginasAgency'=>[
				'method'=>'AMS.Agency.LoginAsAdmin.Id',
				'key'=>'UniqId',
				'icon'=>'fa fa-sign-in',
				'vName'=>'Login as Agency'

			],


			'view'=>[
				'method'=>'AMS.Agency.View.Id',
				'key'=>'UniqId',

			],





		];



						$build->listData($model)->listView($diplayArray)->btn([
												'action'=>"\\B\\AMS\\Controller@agencyAdd",
												'color'=>"btn-info",
												'icon'=>"fa fa-plus",
												'text'=>"Add Agency"
											])->addListAction($link);	

						return $build->view(true,'list');

	}


	public function agencyViewbyId($UniqId){



		$uniqId=\MS\Core\Helper\Comman::de4url($UniqId);
		//$uniqId=$enUniqId;
		$id=0;
		$m=New \B\AMS\Model();

		if($m->where('UniqId',$uniqId)->first()!=null){$agencyData=$m->where('UniqId',$uniqId)->first()->toArray();}
		else{$agencyData=[];}
		$data=[

			'agency'=>$agencyData
		];
		//dd($m->where('UniqId',$uniqId)->first());
	//	dd($newsData);

		return view('AMS.V.Object.AgencyDetails')->with('data',$data);
		//dd($m->where('UniqId',$uniqId)->first()->toArray());




	}


	public function agencyEditbyId($UniqId){


			$id=4;
			$model=new Model($id);
			$build=new \MS\Core\Helper\Builder (__NAMESPACE__);
			//dd($model->where('UniqId',\MS\Core\Helper\Comman::de4url($UniqId))->get()->first()->toArray());
			
			$nullCheck=$model->where('UniqId',\MS\Core\Helper\Comman::de4url($UniqId))->get()->first();
			//dd($nullCheck);
			if($nullCheck =! null ){
				$data=$model->where('UniqId',\MS\Core\Helper\Comman::de4url($UniqId))->get()->first();
			}else{
				$data=[];
			}
			
			
//			dd($data);

			$build->title("Edit Agency ")->content($id,$data)->action("agencyEditbyIdPost");

			$build->btn([
									'action'=>"\\B\\AMS\\Controller@agencyView",
									'color'=>"btn-info",
									'icon'=>"fa fa-fast-backward",
									'text'=>"Back"
								]);
			$build->btn([
									//'action'=>"\\B\\MAS\\Controller@editCompany",
									'color'=>"btn-success",
									'icon'=>"fa fa-floppy-o",
									'text'=>"Save"
								]);

			return $build->view();


	}

	public function agencyEditbyIdPost(R\EditAgency $r){


			$status=200;
			$rData=$r->all();

			//dd($rData);
			$id=0;

			if($rData['Password']==null || $rData['Password']=="" ){unset($rData['Password']);}else{
				$rData['Password']=\MS\Core\Helper\Comman::en($rData['Password']);

			}


//			dd($rData);



			$model=new Model($id);
			$model->MS_update($rData,$id);	

			



			//return ;
			$array=[
	 		'msg'=>"OK",
	 	//	'redirect'=>action('\B\Users\Controller@login_form_otp'),
	 		'redirectData'=>action('\B\AMS\Controller@agencyView'),

	 		// 	'db Password'=>$psw,
	 		// 'in Password'=>$input['Password']
	 		];
	 		$json=collect($array)->toJson();
	 		return response()->json($array, $status);



	}
	public function agencyDeletebyId($UniqId){

			$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);
			$status=200;
			$tableId=0;
			$rData=['UniqId'=>$UniqId];
			$model=new Model($tableId);
			$model->MS_delete($rData,$tableId);	
			\MS\Core\Helper\Comman::DB_flush();
			$m2=new \B\ANMS\Model(1,$rData['UniqId']);
			$m2->deleteTable();

		
			return  $this->agencyView();

	}

	public function agencyLoginAsbyId($UniqId,Request $r){

		$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);
		$session=session('user.userData');

		//dd($r->all());

	//	$r->session()->flush();
		//admin data store
		$r->session()->put('user.adminData', $session);
		

		
		$id=4;
		$m1=new Model($id);
		//dd($m1->where('UniqId',\MS\Core\Helper\Comman::de4url($UniqId))->get());
		$nullCheck=$m1->where('UniqId',\MS\Core\Helper\Comman::de4url($UniqId))->get()->first();
		if($nullCheck =! null ){
				$data=$m1->where('UniqId',$UniqId)->get()->first()->toArray();
			}else{
				$data=[];
			}
			
		$agencyData=[

		"name" => $data['Name'],
 		"email" => $data['AttName'],
  		"UniqId" => $data['UniqId'],
  		];



		$r->session()->put('user.SuperAdmin',1);
  		$r->session()->put('user.userData.name', $agencyData['name']);
  		$r->session()->put('user.userData.email', $agencyData['email']);
  		$r->session()->put('user.userData.UniqId', $agencyData['UniqId']);

  		$status='200';
  		//dd($r->session());
  		$array=[
	 		'msg'=>"OK",
	 	//	'redirect'=>action('\B\Users\Controller@login_form_otp'),
	 		'redirectLink'=>route('APanel.Index')."?agencyCode=".\MS\Core\Helper\Comman::en4url($UniqId),

	 		// 	'db Password'=>$psw,
	 		// 'in Password'=>$input['Password']
	 		];
\Session::save();
$r->session()->save();
	 		//dd(session()->all());
	 		$json=collect($array)->toJson();
	 		return response()->json($array, $status);

  	//	return redirect()->;
	//	dd(session()->all());

	}


	public function backAgencyAsby(){

		$admin=session('user.adminData');
		//session()->flush();
		session()->forget('user.adminData');

		session()->put('user.SuperAdmin',1);
		session()->put('user.userData.name', $admin['name']);
  		session()->put('user.userData.email', $admin['email']);
  		session()->put('user.userData.UniqId', $admin['UniqId']);


		$status='200';

  		$array=[
	 		'msg'=>"OK",
	 	//	'redirect'=>action('\B\Users\Controller@login_form_otp'),
	 		'redirectLink'=>route('Panel.Index'),

	 		// 	'db Password'=>$psw,
	 		// 'in Password'=>$input['Password']
	 		];
	 		$json=collect($array)->toJson();

	 		return redirect()->route('Panel.Index');
	 		return response()->json($array, $status);

	}


}