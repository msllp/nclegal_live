<?php

\MS\Core\Helper\Comman::DB_flush();
$tableId=1;

		$build=new \MS\Core\Helper\Builder ('B\NMS');
		$build->title("View All Notification");
	//	

		$model=new \B\ANMS\Model($tableId,session('user.userData.UniqId'));


		
	//dd();
			$model=$model->orderBy('created_at','desc')->paginate(10);
			\MS\Core\Helper\Comman::DB_flush();

			//dd($model->toArray());
	//	dd($model);

						$diplayArray=[
				//'UniqId'=>'ID',

				'TextOfNotification'=>'Title',
				'created_at'=>'Date & Time'


						];

						$link=[

			'view'=>[
				'method'=>'ANMS.Notification.By.Id',
				'key'=>'UniqId',

			],

			

		];


		$data=[
		'sortBy'=>'created_at',
		//'sortType'=>'l2o'
		];



						$build->listData($model,$data)->listView($diplayArray)
											->addListAction($link)->listGetter(['created_at']);	
						//dd($build->view(true,'list'));
						echo $build->view(true,'list');


 ?>
