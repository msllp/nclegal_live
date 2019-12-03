<?php
namespace B\IM;

class Logics{


	public static function genInvoice($TaskId,$StepId,$FileId,$FileArray){
		
		$id=1;

		$connection=\B\IM\Base::getConnection($id);
		$tableName=\B\IM\Base::getTable($id,$TaskId);

		//dd(Model::checkTableinDB($connection,$tableName));

		if(!Model::checkTableinDB($connection,$tableName)){
			\MS\Core\Helper\Comman::DB_flush();
			Base::migrate([['id'=>$id,'code'=>$TaskId]]);
		}

		//dd($FileArray);
		$fileName=last(explode('/', $FileArray['path']));
		$data=[
			'UniqId'=>Base::genUniqID(),
			'StepId'=>$StepId,
			'DocumentId'=>$FileId,
			'NameofDocument'=>$fileName,
			'TypeOfDocument'=>$FileArray['TypeOfDocument'],
			'PathofDocument'=>$FileArray['path'],
			'Amount'=>$FileArray['AmountOfDocument'],
			'Tax'=>0,
			'StarAprNo'=>0,
			'MasterInvoiceNo'=>0,
			'HasStarAprNo'=>0,
			'HasMasterInvoiceNo'=>0,
			'CurrentStatus'=>'000',
		];

		$m=new Model(1,$TaskId);
		$m->MS_add($data);

		//dd(Model::checkTableinDB($connection,$tableName));

		return true;
	}


	public static function deleteInvoice($TaskId,$StepId,$FileId){



		$id=1;

		$connection=\B\IM\Base::getConnection($id);
		$tableName=\B\IM\Base::getTable($id,$TaskId);

		//dd(Model::checkTableinDB($connection,$tableName));

		if(!Model::checkTableinDB($connection,$tableName)){
			\MS\Core\Helper\Comman::DB_flush();
			Base::migrate([['id'=>$id,'code'=>$TaskId]]);
		}

		$m=new Model(1,$TaskId);
		
		$deleteRow=$m->where('DocumentId',$FileId)->delete();

		if($m->get()->count() < 1) return false;

		//dd(Model::checkTableinDB($connection,$tableName));

		return true;
	}


	public static function getInvoiceByTaskId($TaskId){

		$id=1;

		$connection=\B\IM\Base::getConnection($id);
		$tableName=\B\IM\Base::getTable($id,$TaskId);

		//dd(Model::checkTableinDB($connection,$tableName));

		if(!Model::checkTableinDB($connection,$tableName)){
			\MS\Core\Helper\Comman::DB_flush();
			Base::migrate([['id'=>$id,'code'=>$TaskId]]);
		}

		$m=new Model(1,$TaskId);


		if($m->get()->count()){

			$return =[

				'Total'=>$m->get()->sum('Amount'),
				'Data'=>$m->get()->toArray(),
			];
			return $return;

		}else{
			return [];
		}
		
		


	}

	

	public static function getCurrentStatus(){
		\MS\Core\Helper\Comman::DB_flush();
		
	}



	
}