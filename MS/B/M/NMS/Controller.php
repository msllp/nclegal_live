<?php
namespace B\NMS;

use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{
	public function __construct(){
     

        //$this->middleware('groupname')->except(['method_name']);
    }
	public function index(){




			$data=[

			

			];
		return view('NMS.V.panel_data')->with('data',$data);
		
		
	}


	public function indexData(){




			$data=[

			

			];
		return view('NMS.V.Object.MasterDetails')->with('data',$data);
		
		
	}


	public function checkNotification(Request $r, $UserId,$NotificationCount=0){
		
		\MS\Core\Helper\Comman::DB_flush();	
		$m=new Model(3,session('user.userData.UniqId'));

		$data=$m->where('Read','0')->get()->forPage(1, 5);
		//dd($data->toArray());
		$dataAll=$m->MS_all();

		//dd($r->all());

//dd($NotificationCount);

		if ($data==null or count($dataAll)==$NotificationCount ) {
					
					$status=422;
					$array=[
							'msg'=>"No Notification",
							'countCheck'=>count($dataAll)
					 		
					 		
						];

						 return response()->json($array, $status);

		}else{

			$dData1=$m->where('Read','0')->get()->sortByDesc('created_at')->toArray();
			$dData2=$m->where('Read','1')->get()->sortByDesc('created_at')->toArray();
			$dData[]=[
			'TextOfNotification'=>'View All',
			'NotificationLink'=>route('NMS.index.Data'),

			];

			$dData=array_merge($dData1,$dData2,$dData);
			//dd($dData);



		}








		$status=200;
					$array=[
							'msg'=>"New Notification",
							'dData'=>$dData,
							'countCheck'=>count($data)
					 		
					 		
						];


		
	
		 return response()->json($array, $status);

		dd($data);

	}

	public function viewById($UniqId){
			\MS\Core\Helper\Comman::DB_flush();	
		$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);
		//dd($UniqId);
		\B\NMS\Logics::markReadTask($UniqId);


		\MS\Core\Helper\Comman::DB_flush();	
		$m=new Model(3,session('user.userData.UniqId'));
		$m=$m->where('UniqId',$UniqId)->get()->first()->toArray();
		//dd($m->toArray());
		//return redirect($m['NotificationLink']);

			$status=200;
					$array=[
							'msg'=>"Redirect to data link",
							'redirectModData'=>$m['TargetLink'],
							
					 		
					 		
						];

						return response()->json($array, $status);

	}

}