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

	public function viewById(Request $r,$UniqId){
			\MS\Core\Helper\Comman::DB_flush();	
		$UniqId=\MS\Core\Helper\Comman::de4url($UniqId);
		//dd($UniqId);
		\B\NMS\Logics::markReadTask($UniqId);


		\MS\Core\Helper\Comman::DB_flush();	
		$m=new Model(3,session('user.userData.UniqId'));
		$m=$m->where('UniqId',$UniqId)->get()->first()->toArray();
		//dd($m->toArray());
		//return redirect($m['NotificationLink']);


        $m['NotificationLink']=str_replace('nc.msllp.in',$r->getHttpHost(),$m['NotificationLink']);
        $m['TargetLink']=str_replace('nc.msllp.in',$r->getHttpHost(),$m['TargetLink']);

      //  $m['NotificationLink']=str_replace('http','https',$m['NotificationLink']);
       // $m['TargetLink']=str_replace('http','https',$m['TargetLink']);

        //dd($m);
			$status=200;
					$array=[
							'msg'=>"Redirect to data link",
							'redirectModData'=>$m['TargetLink'],
							
					 		
					 		
						];

						return response()->json($array, $status);

	}

    public function viewByRawId(Request $r,$UniqId){

        //dd($UniqId);
        \B\NMS\Logics::markReadTask($UniqId);


        \MS\Core\Helper\Comman::DB_flush();
        $m=new Model(3,session('user.userData.UniqId'));
        $m=$m->where('UniqId',$UniqId)->get()->first()->toArray();
        //dd($m->toArray());
        //return redirect($m['NotificationLink']);


        $m['NotificationLink']=str_replace('nc.msllp.in',$r->getHttpHost(),$m['NotificationLink']);
        $m['TargetLink']=str_replace('nc.msllp.in',$r->getHttpHost(),$m['TargetLink']);

        //  $m['NotificationLink']=str_replace('http','https',$m['NotificationLink']);
        // $m['TargetLink']=str_replace('http','https',$m['TargetLink']);

        //dd($m);
        $status=200;
        $array=[
            'msg'=>"Redirect to data link",
            'redirectModData'=>$m['TargetLink'],



        ];

        return response()->json($array, $status);

    }

    public function indexDataAjax(Request $r){
        \MS\Core\Helper\Comman::DB_flush();
        //  $m=new \B\TMS\Model(7);
        $tableId=3;
       // $m=new \B\NMS\Model($tableId,session('user.userData.UniqId'));
        $m=new Model(3,session('user.userData.UniqId'));

        $rData = $r->all();
        //dd($rData );
      //  if (!array_key_exists('Status', $rData)) $rData['Status'] = 1;

        //return Datatables::of($m->get())->make(true);
        return \Datatables::of($m->get()->map(function ($user){
            $user->created_at_string=$user->created_at->format("Y/m/d");
            return $user;
        }))->orderByNullsLast()->make(true);



    }

    public function newindex(\Illuminate\Http\Request $r)
    {
        \MS\Core\Helper\Comman::DB_flush();
        $rData = $r->all();
        $status="Open";
        if (!array_key_exists('Status', $rData)) $rData['Status'] = 0;
        if( $rData['Status']) $status="Closed";



        $data=[

            'title'=>[
                'str'=>"View All Notification",
                'icon'=>"fa fa-recycle fa-90"
            ],
            'tableColumn'=>[
                'created_at_string'=>"Created On",
                'TextOfNotification'=>"Details",
               // 'TypeOfNotification'=>"Type of Notification",
              //  'Read'=>'Name of Operator',
            ],

            'ajax'=>route("NMS.index.Data.Ajax"),
        ];
       // dd($data);

        return view("NMS.V.Object.NotificationNew")->with('data',$data);


    }


}