<?php
namespace B\IM;

class Controller extends \App\Http\Controllers\Controller
{
	public function __construct(){
     

        //$this->middleware('groupname')->except(['method_name']);
    }
	public function index(){


		\MS\Core\Helper\Comman::DB_flush();

		$m=new \B\TMS\Model();

		$taskID=$m->where('HasInvoice',true)->get()->pluck('UniqId');
		$dataM=[];
		foreach ($taskID as $key => $value) {
			\MS\Core\Helper\Comman::DB_flush();
			$m2=new Model(1,$value);

			$dataM[$value]=$m2->get()->groupBy('StepId')->toArray();


			
		}





			$data=[

			'dataM'=>$dataM

			];
		return view('IM.V.panel_data')->with('data',$data);
		
		
	}


	public function indexData(){




			$data=[

			

			];
		return view('IM.V.Object.MasterDetails')->with('data',$data);
		
		
	}

	public function viewInvoiceDetails($AgencyCode,$InvoiceCode){

		$data=[

			'AgencyCode'=>\MS\Core\Helper\Comman::de4url($AgencyCode),
			'InvoiceCode'=>\MS\Core\Helper\Comman::de4url($InvoiceCode)

		];
		return view("IM.V.Object.InvoiceViewDetails")->with('data',$data);



	}

	public function viewInvoiceDetailsDataLink($data){
		$exp=explode("_",$data);
		//dd();
			$data=[

			'AgencyCode'=>$exp[1],
			'InvoiceCode'=>$exp[2]

		];
		return view("IM.V.Object.InvoiceViewDetails")->with('data',$data);





	}

	public function addInvoicePayments($AgencyCode,$InvoiceCode){

		$data=[

			'AgencyCode'=>\MS\Core\Helper\Comman::de4url($AgencyCode),
			'InvoiceCode'=>\MS\Core\Helper\Comman::de4url($InvoiceCode)

		];

			return view("IM.V.Object.InvoiceAddDetails")->with('data',$data);





	}


	public function addInvoicePaymentsPost(R\addInvoicePayments $r ,$AgencyCode,$InvoiceCode){

	$data=[

			'AgencyCode'=>\MS\Core\Helper\Comman::de4url($AgencyCode),
			'InvoiceCode'=>\MS\Core\Helper\Comman::de4url($InvoiceCode)

		];
	$input=$r->all();
	
	$TaskId=\B\IM\F\Invoice::addPaymentToInvoiceId($input['Amount'],$data)['TaskId'];




			$status="200";

		$array=[

			'redirectModData'=>route('TMS.Task.View.Id',['UniqId'=>\MS\Core\Helper\Comman::en4url($TaskId)])

		];	

		return response()->json($array,$status);

	}

	public function getInvoiceByAgencyAjax($AgencyCode){

			$data=[

			'AgencyCode'=>\MS\Core\Helper\Comman::de4url($AgencyCode),
			//'InvoiceCode'=>\MS\Core\Helper\Comman::de4url($InvoiceCode)

		];
			$m1=new \B\IM\Model(\B\IM\F\Invoice::$lederTableId,$data['AgencyCode']);

			if($m1->checkCurrentTable()){
			$hasInvoices=1;
			$m1=new \B\IM\Model(\B\IM\F\Invoice::$lederTableId,$data['AgencyCode']);

				//return Datatables::of($m->get())->make(true);	
return \Datatables::of($m1->get()->map(

	function ($user){
    //$user->HireAgencyCode = \B\AMS\Logics::getAgencyName($user->HireAgencyCode);
   $user->created_at_string = \Carbon::parse($user->created_at)->format('d/m/Y');
   $user->Total=\MS\Core\Helper\Comman::toINR($user->Total);

  	//$user->created_at_string=$user->created_at->format("Y/m/d");
  //$user->CurrentStatus=\B\TMS\Logics::getTypeOfAction($user->CurrentStatus)['NameOfAction'];
    //dd(\Carbon::parse($user->created_at)->format('d-m-Y'));
    return $user;
}) )->orderByNullsLast()->make(true);



			}			


			return $status="422";

		$array=[

			'msg'=>['404'=>'No Agency Ledger Table Found'],

		];
	}

}