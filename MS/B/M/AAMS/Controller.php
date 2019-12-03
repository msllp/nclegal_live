<?php
namespace B\AAMS;
use Illuminate\Http\Request;
class Controller extends \App\Http\Controllers\Controller
{
	public function __construct(){
     	
     	 $this->middleware('agencyAdmin')->except(['agentPanel','agentsLoginPage','agentLoginPost','agentsViewbyId','agentLoctionPostMs','agentsLogout','agentTaskPost','agentPanelData','agentUploadForm','agentUploadPost','indexData']);

       $this->middleware('agencyAgent')->except(['agentsLoginPage','agentLoginPost','agentAdd','agentAddPost','agentsViewbyId','agentDeletebyId','indexData','index','editAgentForm','editAgentFormPost']);


   //    $this->middleware('agencyAdmin')->only(['index','indexData','agentDeletebyId','agentAdd','agentAddPost','agentsViewbyId','editAgentForm','editAgentFormPost']);

	  
	  // $this->middleware('agencyAgent')->only(['index','indexData','agentAdd','agentAddPost','agentsViewbyId','editAgentForm','editAgentFormPost']);

        
    }
	public function index(){

		// dd(env('APP_ENV'));
		 \MS\Core\Helper\Comman::DB_flush();
		 $m=new \B\AMS\Model();

		 //dd($m->MS_all()->toArray());


		 // foreach ($m->MS_all()->toArray() as $key => $value) {
		 	
			// 	\B\AAMS\Base::migrate([ 
			// 		[
			// 		'id'=>3,
			// 		'code'=>$value['UniqId']
			// 		]
			// 				]);

		 //  }

		
	//	dd($m);



			$data=[

			

			];
		return view('AAMS.V.panel_data')->with('data',$data);
		
		
	}


	public function indexData(){


			$data=[

			

			];

	
		return view('AAMS.V.Object.MasterDetails')->with('data',$data);
		
		
	}


	public function agentAdd(){
//Base::migrate([['id'=>'0']]);
	
  \MS\Core\Helper\Comman::DB_flush();
			$id=1;

		$build=new \MS\Core\Helper\Builder (__NAMESPACE__);

		$build->title("Add Agent")->heading(['Basic Details of Agent'])->content($id)->action("agentAdd")->btn([
								'action'=>"\\B\\AAMS\\Controller@indexData",
								'color'=>"btn-info",
								'icon'=>"fa fa-fast-backward",
								'text'=>"Back"
							])->btn([
								//'action'=>"\\B\\MAS\\Controller@addCCPost",
								'color'=>"btn-success",
								'icon'=>"fa fa-floppy-o",
								'text'=>"Save"
							]);


		return $build->view();
	}



	public function agentAddPost(R\AddAgent $r){

		$agencCode=session('user.userData.UniqId');

		$return =Logics::makeAgent($agencCode,$r);
	
		 return response()->json($return['data'], $return['status']);


	}


	public  function agentsViewbyId($UniqId){


		$uniqId=\MS\Core\Helper\Comman::de4url($UniqId);
		//$uniqId=$enUniqId;
		$id=3;
		  \MS\Core\Helper\Comman::DB_flush();

		  $code=session('user.userData.UniqId');

		  

		  if($code==null)$code=session('agent.AgencyCode');
		$m=New \B\AAMS\Model($id,$code);

		if($m->where('AgentCode',$uniqId)->first()!=null){$agencyData=$m->where('AgentCode',$uniqId)->first()->toArray();}
		else{$agencyData=[];}
		$data=[

			'agent'=>$agencyData
		];
		//dd($m->where('UniqId',$uniqId)->first());
	//	dd($newsData);

		return view('AAMS.V.Object.AgentDetails')->with('data',$data);
		//dd($m->where('UniqId',$uniqId)->first()->toArray());

	}



	public function agentDeletebyId($UniqId){

		$uniqId=\MS\Core\Helper\Comman::de4url($UniqId);
		$agencyCode=session('user.userData.UniqId');

		$return =Logics::deleteAgent($agencyCode,$uniqId);
	
		 return response()->json($return['data'], $return['status']);



	}


	public function  agentsLoginPage(){

		//dd(session()->all());
		if(session()->has('agent')){

			 return redirect()->route("AAMS.Agent.Panel");
		}

		return view("AAMS.V.Pages.AgentLogin");
	


	}



	public function agentLoginPost(R\AgentLogin $r){

		$input=$r->all();

		$data=Logics::loginAgent($input);
		//dd(session()->all());

		return response()->json($data['data'], $data['status']);

		return response()->json([ "msg"=> ['Password'=>[$data['msg']]]], 422);

	}

	public function agentPanel(){

		\MS\Core\Helper\Comman::DB_flush();
//dd(session()->all());
//dd(session()->all());
			$data=[

			

			];

			return view('AAMS.V.Pages.homeForAgent')->with('data',$data);
		//return view('AAMS.V.Pages.home')->with('data',$data);
	}



	public function agentPanelData(){

		\MS\Core\Helper\Comman::DB_flush();
//dd(session()->all());
//dd(session()->all());
			$data=[

			

			];

			return view('AAMS.V.Object.MasterDetailsForAgent')->with('data',$data);
		//return view('AAMS.V.Pages.home')->with('data',$data);
	}



	public function agentLoctionPostMs(R\AgentLocationPostNew $r ){


		$input=$r->all();
		//dd($input);

		$data=Logics::agentLocationStamp($input);
		//dd($data);

		return response()->json(['Ok' ],200);

		


	}


	public function agentTaskPost(R\AgentTaskPost $r){

			$input=$r->all();

		$data=Logics::agentTask($input);


		return response()->json($data['data'], $data['status']);


	}

	public function agentsLogout(){	

		Logics::agentLogout();

		return redirect()->route("AAMS.Agent.Panel");

	}


	public function agentUploadForm($agentCode){

		$data['AgentCode']=\MS\Core\Helper\Comman::de4url($agentCode);


		$data['NameSpace']=__NAMESPACE__;

		return view('AAMS.V.Object.AgentUploadForm')->with('data',$data);


	}

	public function agentUploadPost( R\AgentUpload  $r,$agentCode){
        $data['AgentCode']=\MS\Core\Helper\Comman::de4url($agentCode);
        $rData= $r->all();
        \MS\Core\Helper\Comman::DB_flush();
        $m=new Model(3,explode("_",$data['AgentCode'])[0]);
      //  dd($m);
        $m=$m->where('AgentCode', $data['AgentCode'])->get()->first()->toArray()['AgentCurrentTask'];

        $table=\B\ADMS\Base::getTable(1,$data['AgentCode']."_".$m);
        $connection=Base::getConnection(1);


        

        if(!\Schema::connection($connection)->hasTable($table)){

            \B\ADMS\Base::migrate(
                [
                    [

                        'id'=>1,
                        'code'=> $data['AgentCode']."_".$m,

                    ]

                ]

            );

        }


        $m4=\B\ADMS\Base::getTypeofDocuments();


        $path=[];


        foreach ($m4 as $key => $value) {
            $path[$key]='Data'.DIRECTORY_SEPARATOR.$data['AgentCode']."_".$m.DIRECTORY_SEPARATOR.$key;
        }
       // dd($path);


        foreach ( $rData['agencyDocument']  as $key=>$value){
            $uniqId=\MS\Core\Helper\Comman::random(3);
            $fileName=\B\ADMS\Logics::getTypeOfDocumentFromId ($rData['TypeOfDocuments'][ $key])['NameOfDocuments']."_".$uniqId.".".$rData['agencyDocument'][ $key]->getClientOriginalExtension();


            $fData=[
                'UniqId'=>$uniqId,
                'TypeOfDocument'=>$rData['TypeOfDocuments'][ $key],
                'NameOfDocument'=>$fileName,
                'Path'=>$path[$rData['TypeOfDocuments'][ $key]].DIRECTORY_SEPARATOR.$fileName,
                'AmountOfDocument'=>$rData['AmountOfDocument'][ $key],
                'InvoiceIncludeCode'=>"000",
                'CurrentStatus'=>"0",
                'Status'=>'1',
            ];

            $value->storeAs($path[$rData['TypeOfDocuments'][$key]]   ,  $fileName,'ADMS');

            //dd($fData);
            \MS\Core\Helper\Comman::DB_flush();
            $m1=new \B\ADMS\Model(1,$data['AgentCode']."_".$m);
            $m1->MS_add($fData);


        }

         $status=200;
		        $array=[
                    'msg'=>"OK",
                    'redirectData'=>action('\B\AAMS\Controller@agentPanelData'),

                ];

        return response()->json($array, $status);
	}

	public function editAgentForm($agentCode){

		$agentCode=\MS\Core\Helper\Comman::de4url($agentCode);
		$exAgenctCode=explode("_", $agentCode);

		$agencyCode=reset($exAgenctCode);
	//	dd(Logics::editAgent($agentCode));
		  \MS\Core\Helper\Comman::DB_flush();
			$id=7;

 		$build=new \MS\Core\Helper\Builder ('B\AAMS');

		$build->title("Edit Agent")->heading(['Basic Details of Agent'])->setPerfix($agencyCode)->content($id,['AgentCode'=>$agentCode])->btn([
								'action'=>"\\B\\AAMS\\Controller@indexData",
								'color'=>"btn-info",
								'icon'=>"fa fa-fast-backward",
								'text'=>"Back"
							])->btn([
								//'action'=>"\\B\\MAS\\Controller@addCCPost",
								'color'=>"btn-success",
								'icon'=>"fa fa-floppy-o",
								'text'=>"Save"
							])->action('editAgentFormPost');


		return $build->view();

	}


	public function editAgentFormPost(R\EditAgent $r){

		$input=$r->all();

		$return =Logics::editAgent($input['AgentCode'],$input);
	
		 return response()->json($return['data'], $return['status']);


	}
}