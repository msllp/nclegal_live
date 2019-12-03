<?php
//dd($data);

\MS\Core\Helper\Comman::DB_flush();
$tableId=1;

		$build=new \MS\Core\Helper\Builder ('B\TMS');
		$build->title("View All Task");
	//	

		$model=new \B\TMS\Model(7);


		
	//dd();
			$model=$model->where('HireAgencyCode',$data['TaskId'])->paginate(100);
			\MS\Core\Helper\Comman::DB_flush();

			//dd($model->toArray());
	//	dd($model);

						$diplayArray=[
				'UniqId'=>'Task ID',

				//	'HireAgencyCode'=>'Name of Assined Agency',


				//'NewsDate'=>'Date',

				'NameOperator'=>'Name of Operator',

				'IllegalTypeBroadcasting'=>'Type Broacasting',
				

				'ModePiracy'=>'Mode of Piracy',
				'NameOfNetwork'=>'LCO/MCO name',

				'CurrentStatus'=>'Cur. Status',


						];

						$link=[

			'view'=>[
				'method'=>'TMS.Task.View.Id',
				'key'=>'UniqId',

			],

			

		];


		$data=['sortyBy'=>'created_at',
		];



						$build->listData($model,$data)->listView($diplayArray)
											->addListAction($link)->listGetter(['CurrentStatus']);	
						//dd($build->view(true,'list'));

						echo $build->view(true,'list');



?>