<?php 






		$tableId=7;

		$build=new \MS\Core\Helper\Builder ('B\TMS');
		//$build->title("View All Agency");

		//dd(session()->all());
	$uniqId=session('user.userData.UniqId');

	$model=new \B\TMS\Model($tableId);

	$model=$model->where('Status',0)->where('HireAgencyCode',$uniqId);
	//dd($model);
	//dd($model->where('HireAgencyCode',$uniqId)->get()->toArray());
	//dd($model);

	$model=$model->paginate($tableId);
	//	dd($model);

						$diplayArray=[
				//'UniqId'=>'ID',

				'NameOperator'=>'Name of Piracy network',


				//'NewsDate'=>'Date',

				'NameOwner'=>'Name of Owner',

				'NameAreaPiracyState'=>'Area of Piracy',
				

				'IllegalTypeBroadcasting'=>'Illegal Broadcasting',


				'CurrentStatus'=>'Cur. Status',

						];

						$link=[

			// 'delete'=>[
			// 	'method'=>'AMS.Agency.Delete.Id',
			// 	'key'=>'UniqId',

			// ],

			// 'edit'=>[
			// 	'method'=>'AMS.Agency.Edit.Id',
			// 	'key'=>'UniqId',

			// ],


			'view'=>[
				'method'=>'ATMS.Task.View.Id',
				'key'=>'UniqId',

			],

		];


			$data=[

		'paginate'=>true,
		"paginate-limit"=>10,
		];



						$build->listData($model,$data)->listView($diplayArray)
						// btn([
						// 						'action'=>"\\B\\AMS\\Controller@agencyAdd",
						// 						'color'=>"btn-info",
						// 						'icon'=>"fa fa-plus",
						// 						'text'=>"Add Agency"
						// 					])
						->addListAction($link)->listGetter(['CurrentStatus'])
						;	

				///	dd($build);


					echo $build->view(true,'list')->render();



?>