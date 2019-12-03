<?php
namespace B\ANMS;

class Logics{



	public static function newNotification($userId,$admin=1,$UniqId,$typeOfNotification,$text=null,$link=null,$targetLink=null){

		\MS\Core\Helper\Comman::DB_flush();




		$addArray=[


		'UniqId'=>$UniqId,
		'TextOfNotification'=>self::getTypeofDocument($typeOfNotification).$text,
		'TypeOfNotification'=>$typeOfNotification,
		'Read'=>0,
		'NotificationLink'=>$link,
		'TargetLink'=>$targetLink,
		];



//dd($addArray);
		// $m=new Model(3,$userId);
		// $m=$m->MS_add($addArray);


			\MS\Core\Helper\Comman::DB_flush();
			$m=new Model(1,$userId);
			$m=$m->MS_add($addArray);
			\MS\Core\Helper\Notify::send('agency','newMessage',$addArray);


		//event(new \B\NMS\E\MessagePosted ($addArray['UniqId'],$addArray['TextOfNotification']));
		//dd($addArray);





	}


	public static function getTypeofDocument($code){

		\MS\Core\Helper\Comman::DB_flush();
		$m=new \B\NMS\Model(1);

		return $m->getTypeofDocumentById($code);
	}



	public static function readNotificationForAdmin($rowData,$m){


			$rowData['ReadUserCode']=json_decode($rowData['ReadUserCode'],true,3);
			$rowData['ReadUserArray']=json_decode($rowData['ReadUserArray'],true,3);
		
			if(!in_array(session('user.userData.UniqId'), $rowData['ReadUserCode']))$rowData['ReadUserCode'][]=session('user.userData.UniqId');

			if(!array_key_exists(session('user.userData.UniqId'), $rowData['ReadUserArray']))
			{

				$rowData['ReadUserArray'][session('user.userData.UniqId')]=[

				'UserCode'=>session('user.userData.UniqId'),
				'Timestamp'=>\Carbon::now()->toDateTimeString(),
				];


				$upData['ReadUserCode']=collect($rowData['ReadUserCode'])->toJson();
				$upData['ReadUserArray']=collect($rowData['ReadUserArray'])->toJson();

				$m->MS_update($upData,$rowData['UniqId']);
			}


	}

	public static function markReadTask($UniqId){


			$upArray=[
			'Read'=>1
			];

			//dd($UniqId);
			\MS\Core\Helper\Comman::DB_flush();
			//dd(session('user.userData.UniqId'));	
			$m=new Model(1,session('user.userData.UniqId'));
			//dd($m->where('UniqId',$UniqId)->get());
			//dd($m);
			$m->MS_update($upArray,$UniqId);
			
			//dd($m->MS_update($upArray,$UniqId));

	}



	public static function getcreated_at($code){


		

		$code=\Carbon::parse($code)->format('l jS \\of F Y h:i:s A');

		//dd($model->getHireAgencyCodeFromId($code));

		return $code;


	}

	
}