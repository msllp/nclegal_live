<?php 






		$tableId=0;
$data=[
    'sortBy'=>'updated_at',
    'paginate'=>false,
    "paginate-limit"=>10,
];
		$build=new \MS\Core\Helper\Builder ("B\AMS");
		//$build->title("View All Agency");
	//	

		$model=new \B\AMS\Model($tableId);
		$model=$model->paginate($data['paginate-limit']);
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

	

			// 'edit'=>[
			// 	'method'=>'AMS.Agency.Edit.Id',
			// 	'key'=>'UniqId',

			// ],


			'view'=>[
				'method'=>'AMS.Agency.View.Id',
				'key'=>'UniqId',

			],

				'LoginasAgency'=>[
				'method'=>'AMS.Agency.LoginAsAdmin.Id',
				'key'=>'UniqId',
				'icon'=>'fa fa-sign-in',
				'vName'=>'Login as Agency'

			],

		];


						$build->listData($model,$data)->listView($diplayArray)->btn([
												'action'=>"\\B\\AMS\\Controller@agencyAdd",
												'color'=>"btn-info",
												'icon'=>"fa fa-plus",
												'text'=>"Add Agency"
											])->addListAction($link);

						echo $build->view(true,'list');



?>