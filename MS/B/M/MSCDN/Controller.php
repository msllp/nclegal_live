<?php
namespace B\MSCDN;

class Controller extends \App\Http\Controllers\Controller
{
	public function __construct(){
     

        //$this->middleware('groupname')->except(['method_name']);
    }
	public function index(){




			$data=[

			

			];
		return view('MSCDN.V.panel_data')->with('data',$data);
		
		
	}


	public function indexData(){




			$data=[

			

			];
		return view('MSCDN.V.Object.MasterDetails')->with('data',$data);
		
		
	}

	public function searchTask(\Illuminate\Http\Request $r){

		$input=$r->all();
		//dd($r->all());

		if(array_key_exists('TypeOfSearch' ,$input)) {


			switch ($input['TypeOfSearch']) {
				case '0':


					\MS\Core\Helper\Comman::DB_flush();
					$m1=new \B\AMS\Model();
					$data=$m1->MS_all()->pluck('Name')->toArray();
					//dd();

					//$data=[];
					$status=200;
					$array=[
							'data'=>$data,
					 	//	'redirectData'=>action('\B\TMS\Controller@indexData'),
					 		
						];

					return response()->json($array, $status);
					break;

				case '1':


					\MS\Core\Helper\Comman::DB_flush();
					$m2=new \B\TMS\Model(6);

					$mData=$m2->MS_all()->pluck('NameOfAction','UniqId');

					//dd($mData);

					\MS\Core\Helper\Comman::DB_flush();
					$m1=new \B\TMS\Model(0);


					$data=$m1->get()->groupBy('CurrentStatus')->toArray();
					//dd();

					$types=array_keys($data);

					
					$rData=[];

					foreach ($types as $value) {
						
						$rData[$mData[$value]]=$mData[$value];


					}
					//dd($rData);
					//$data=[];
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




}