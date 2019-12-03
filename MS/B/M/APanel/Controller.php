<?php
namespace B\APanel;

use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{
	public function __construct(){
     
		 $this->middleware('agencyAdmin')->except(['login_form']);
        //$this->middleware('groupname')->except(['method_name']);
    }






	public function login_form(){
		return view('APanel.V.Pages.login_form')	;
	}



	public function index(Request $r){

\MS\Core\Helper\Comman::DB_flush();
//dd(session()->all());

if(session()->has('user.SuperAdmin') && session('user.SuperAdmin') ){


if(array_key_exists('agencyCode', $r->all()))
{

	if(!session()->has('user.adminData')){


		//dd(session()->all());

		$UniqId=\MS\Core\Helper\Comman::de4url($r->all()['agencyCode']);

		$id=4;
		$m1=new \B\AMS\Model($id);
		//dd($m1->where('UniqId',\MS\Core\Helper\Comman::de4url($UniqId))->get());
		$nullCheck=$m1->where('UniqId',\MS\Core\Helper\Comman::de4url($UniqId))->get()->first();
		if($nullCheck =! null ){
				$data=$m1->where('UniqId',$UniqId)->get()->first()->toArray();
			}else{
				$data=[];
			}

			$session=session('user.userData');

			session()->flush();
			//admin data store
			session()->put('user.adminData', $session);

			$agencyData=[

		"name" => $data['Name'],
 		"email" => $data['AttName'],
  		"UniqId" => $data['UniqId'],
  		];



		session()->put('user.SuperAdmin',1);
  		session()->put('user.userData.name', $agencyData['name']);
  		session()->put('user.userData.email', $agencyData['email']);
  		session()->put('user.userData.UniqId', $agencyData['UniqId']);

			//dd(session()->all());
	}

	

}



}



			$data=[

			

			];

		return view('APanel.V.Pages.home')->with('data',$data);

	//	return view('APanel.V.panel_data')->with('data',$data);
		
		
	}
public function indexDataWithSide(){
\MS\Core\Helper\Comman::DB_flush();

			$data=[

			

			];

		//return view('APanel.V.Pages.home')->with('data',$data);

	return view('APanel.V.panel_data')->with('data',$data);
		


}




	public function indexData(){

\MS\Core\Helper\Comman::DB_flush();


			$data=[

			

			];
		return view('APanel.V.Object.MasterDetails')->with('data',$data);
		
		
	}


	public function logout(Request $r){
		$r->session()->flush();
		return redirect()->action("\B\APanel\Controller@index");
	}

}