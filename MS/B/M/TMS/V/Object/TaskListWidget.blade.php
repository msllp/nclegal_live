<?php 

	
			$tableId=7;
$data=[
    'sortBy'=>'updated_at',
    'paginate'=>false,
    "paginate-limit"=>10,
];
		\MS\Core\Helper\Comman::DB_flush();
		$build=new \MS\Core\Helper\Builder ('B\\TMS');
	//	$build->title("View All Assined Task");
	//	
		\MS\Core\Helper\Comman::DB_flush();
		$model=new \B\TMS\Model($tableId);

		$model=$model->where('Status',0)->orderBy('id')->paginate($data['paginate-limit']);

            $diplayArray=[

				'UniqId'=>'ID',

				'HireAgencyCode'=>'Name of Assined Agency',


				//'NewsDate'=>'Date',

				'NameOperator'=>'Name of Operator',

				//'IllegalTypeBroadcasting'=>'Type Broacasting',
				

				'ModePiracy'=>'Mode of Piracy',
				//'NameOfNetwork'=>'LCO name',

				'CurrentStatus'=>'Cur. Status',

						];

						$link=[

			// 'delete'=>[
			// 	'method'=>'AMS.Agency.Delete.Id',
			// 	'key'=>'UniqId',

			// ],

			


		
			'view'=>[
				'method'=>'TMS.Task.View.Id',
				'key'=>'UniqId',]
			// ],

		];





						$build->listData($model,$data)->listView($diplayArray)->btn([
												'action'=>"\\B\\TMS\\Controller@taskAdd",
												'color'=>"btn-info",
												'icon'=>"fa fa-plus",
												'text'=>"Add Task"
											])->btn( 
											[
												'action'=>"\\B\\TMS\\Controller@taskViewByColumn",
												'color'=>"btn-default",
												'icon'=>"fa fa-eye",
												'text'=>"Group By Agency",
												'data'=>'HireAgencyCode'
											])
	
											->btn( 
											[
												'action'=>"\\B\\TMS\\Controller@taskViewByColumn",
												'color'=>"btn-default",
												'icon'=>"fa fa-eye",
												'text'=>"Group By State",
												'data'=>'NameOperatorState'
											])
											->btn( 
											[
												'action'=>"\\B\\TMS\\Controller@taskViewByColumn",
												'color'=>"btn-default",
												'icon'=>"fa fa-eye",
												'text'=>"Group By Month",
												'data'=>'created_at'
											])
											->addListAction($link)->listGetter(['HireAgencyCode','CurrentStatus']);	
						\MS\Core\Helper\Comman::DB_flush();
						echo $build->view(true,'list');
						


?>

