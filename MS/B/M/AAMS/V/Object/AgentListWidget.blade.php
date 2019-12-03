<?php 

        $tableId=1;

		$build=new \MS\Core\Helper\Builder ("B\AAMS");
		//$build->title("View All Agency");
		\MS\Core\Helper\Comman::DB_flush();
		$agencCode=session('user.userData.UniqId');
		if($agencCode==null){
			$agencCode=session('agent.AgencyCode');
		}

		if(isset($data)) {


			if(array_key_exists('AgencyCode', $data))$agencCode=$data['AgencyCode'];
			
		}
			# code...
		
		//dd(session()->all());
		
		$model=new \B\AAMS\Model($tableId,$agencCode);
		$model=$model->paginate(10);
	//	dd($model);

						$diplayArray=[

				'AgentCode'=>'Agent Code',

				'AgentName'=>'Agent Name',
				

				'AgentUsername'=>'Username',


				'AgentContactNo'=>'Contact No.',

						];

						$link=[	

	

			'edit'=>[
				'method'=>'AAMS.Agent.edit',
				'key'=>'AgentCode',

			],


			'view'=>[
				'method'=>'AAMS.Agent.View.Id',
				'key'=>'AgentCode',

			],


			// 'delete'=>[
			// 	'method'=>'AAMS.Agent.Delete.Id',
			// 	'key'=>'AgentCode',

			// ],

			// 	'LoginasAgency'=>[
			// 	'method'=>'AMS.Agency.LoginAsAdmin.Id',
			// 	'key'=>'UniqId',
			// 	'icon'=>'fa fa-sign-in',
			// 	'vName'=>'Login as Agency'

			// ],

		];

		if(session('user.userData.UniqId')!=null && !array_key_exists('AgencyCode', $data)){

			$link['delete']=[
				'method'=>'AAMS.Agent.Delete.Id',
				'key'=>'AgentCode',

			];

		}
	
		if(isset($data)){

if(array_key_exists('AgencyCode', $data)){
	unset($link['delete']);
	unset($link['view']);
};
		}



						$build->listData($model)->listView($diplayArray)->addListAction($link);	

							if(isset($data)) {


			if(array_key_exists('actionBtn', $data) && $data['actionBtn']==false )$build->btn([
												'action'=>"\\B\\AAMS\\Controller@agentAdd",
												'color'=>"btn-info",
												'icon'=>"fa fa-plus",
												'text'=>"Add Agent"
											]);
			if(array_key_exists('AgencyCode', $data))$agencCode=$data['AgencyCode'];
			
		}

						$build->btn([
												'action'=>"\\B\\AAMS\\Controller@agentAdd",
												'color'=>"btn-info",
												'icon'=>"fa fa-plus",
												'text'=>"Add Agent"
											]);

						//dd( $build->view(true,'list') );
						echo $build->view(true,'list');



?>

<a href='https://play.google.com/store/apps/details?id=com.millionsllp.agentapp&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1' target="_blank">
<img alt='Get it on Google Play From Million Solutions LLP' src='https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png' style="max-height: 60px;" /></a>
<script type="text/javascript"> 

	//	Android.showToast("demo");

//          Android.setUser(" {{session('agent.AgencyCode')}}", "{{session('agent.AgentCode')}}", "{{session('agent.ApiToken' )}}" );
      

</script>
