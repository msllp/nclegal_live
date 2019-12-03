<?php

namespace B\IM\F;


class Invoice{

	public static $lederTableId=3;

	public static $TableIdForInvoice=1;

	public static $TableIdForSubLedger=4;

	public static function checkLedgerOrMakeLeder($AgencyCode){


		$id=self::$lederTableId;

		$connection=\B\IM\Base::getConnection($id);
		$tableName=\B\IM\Base::getTable($id,$AgencyCode);

		//dd(Model::checkTableinDB($connection,$tableName));

		if(!\B\IM\Model::checkTableinDB($connection,$tableName)){
			\MS\Core\Helper\Comman::DB_flush();
			\B\IM\Base::migrate([['id'=>$id,'code'=>$AgencyCode]]);
		}

		return true;


	}

	public static function inWardInvoiceForAgencyLedger($AgencyCode,$TaskId,$inputArray){

		$InvoiceId= \MS\Core\Helper\Comman::random(2,1);


		$fData=[
			'UniqId'=>$InvoiceId,
			'id'=>$InvoiceId,
			'MasterInvoiceId'=>$inputArray['MasterInvoiceNo'],
			'TaskId'=>$TaskId,
			//'InvoiceIdOfLF'=>0,
			'NotifyNo'=>$inputArray['NotificationNo'],
			'DateOfPaymentToAgency'=>0,
			'Paid'=>0,
			'PartiallyPaid'=>0,
			'Total'=>0,
			'TotalPaid'=>0,
			'InvoiceIncluded'=>collect(array_keys($inputArray['SelectedFiles']))->toJson(),
			'PaymentStatus'=>0,	
		];
		\MS\Core\Helper\Comman::DB_flush();
		$id1=self::$lederTableId;
		$m1=new \B\IM\Model($id1,$AgencyCode);
		$m11=$m1->where('MasterInvoiceId',$inputArray['MasterInvoiceNo'])->get();
		if($m11->count() <  1){

			$m1->MS_add($fData);
			self::makeInvoiceTableForSub($InvoiceId,$AgencyCode);
		}else{

			$InvoiceId=$m11->first()->toArray()['UniqId'];
		}
		

		self::makeInvoiceEntryInSub($InvoiceId,$AgencyCode,$TaskId,$inputArray['SelectedFiles']);
		//self::deleteInvoice($InvoiceId,$AgencyCode);
		return true;
	

	}


	public static function makeInvoiceTableForSub($InvoiceId,$AgencyCode){

		$id=4;
		$codeForTable=implode('_', [$AgencyCode,$InvoiceId]);
		$connection=\B\IM\Base::getConnection($id);
		$tableName=\B\IM\Base::getTable($id,$codeForTable);

		//dd(Model::checkTableinDB($connection,$tableName));

		if(!\B\IM\Model::checkTableinDB($connection,$tableName)){
			\MS\Core\Helper\Comman::DB_flush();
			\B\IM\Base::migrate([['id'=>$id,'code'=>$codeForTable]]);
		}

		return true;


	}


	public static function makeInvoiceEntryInSub($InvoiceId,$AgencyCode,$TaskId,$FileArray){

		\MS\Core\Helper\Comman::DB_flush();
		$m1=new \B\IM\Model(self::$TableIdForInvoice,$TaskId);
		$total=0;
		$TaxTotal=0;

		foreach ($FileArray as $key => $value) {

			$m11=$m1->where('UniqId',$key)->get();
			if($m11->count() > 0){

				$m111=$m11->first()->toArray();

				
				  $codeForTable=implode('_', [$AgencyCode,$InvoiceId]);
				  \MS\Core\Helper\Comman::DB_flush();
				  $m2=new \B\IM\Model(self::$TableIdForSubLedger,$codeForTable);
				  $m22=$m2->where('UniqId',$key)->get();
			
		//	dd($m1);
				  $m1->MS_update(['HasMasterInvoiceNo'=>1,'MasterInvoiceNo'=>$InvoiceId],$m111['UniqId']);
				  if($m22->count()< 1){

				  	$fdata1=  [

				  				  "UniqId" => $m111['UniqId'],
				  				  "StepId" => $m111['StepId'],
				  				  "DocumentId" => $m111['DocumentId'],
				  				  "TypeOfDocument" => $m111['TypeOfDocument'],
				  				  "NameofDocument" => $m111['NameofDocument'],
				  				  "PathofDocument" => $m111['PathofDocument'],
				  				  "Amount" => $m111['Amount'],
				  				  "Tax" => $m111['Tax'],
				  				 ];


				  	$total=$total+$m111['Amount'];
					$TaxTotal=$TaxTotal+$m111['Tax'];
					$m2=new \B\IM\Model(self::$TableIdForSubLedger,$codeForTable);
				  	$m2->MS_add($fdata1);



				  }



			}



	
		}

		\MS\Core\Helper\Comman::DB_flush();
		$m1=new \B\IM\Model(self::$lederTableId,$AgencyCode);

		$m1->MS_update(['Total'=>$total],$InvoiceId);

		



	}





	public static function deleteInvoice($InvoiceId,$AgencyCode){
		\MS\Core\Helper\Comman::DB_flush();
		$codeForTable=implode('_', [$AgencyCode,$InvoiceId]);
		$m=new \B\IM\Model(self::$lederTableId,$AgencyCode);
		
		$data=[
			'UniqId'=>$AgencyCode
		];
		$dataArray=[
			'UniqId'=>$InvoiceId
		];

		$m->MS_delete($data,self::$lederTableId,$dataArray);

		\MS\Core\Helper\Comman::DB_flush();
		$m2=new \B\IM\Model(self::$TableIdForSubLedger,$codeForTable);
		$m2->deleteTable();

		return true;





	}



	public static function addPaymentToInvoiceId($Amount,$data){
		\MS\Core\Helper\Comman::DB_flush();
		$return=[];
		$debug=1;
		$invoiceData=[];

		$fData=[

			//'PartiallyPaid'=>1
			'Paid'=>0

		];

		$codeForTable=implode('_', [$data['AgencyCode'],$data['InvoiceCode']]);
		$m1=new \B\IM\Model(self::$lederTableId, $data['AgencyCode'] );

		$m11=$m1->where('UniqId',$data['InvoiceCode']);
		///Enter Part in AGency Ledger
		if($m11->get()->count() > 0 ){

			$invoiceData=$m11->get()->first()->toArray();
			if($invoiceData['Total'] > $Amount){
				$fData['TotalPaid']=$invoiceData['TotalPaid']+$Amount;
				$fData['PartiallyPaid']=1;

			}
			if($invoiceData['Total'] == $Amount){
				$fData['TotalPaid']=$Amount;
				$fData['Paid']=1;
				$fData['PartiallyPaid']=0;
				$fData['DateOfPaymentToAgency']=\Carbon::now()->toDateTimeString();
			}

			if($invoiceData['Total'] < $Amount)$debug=0;
			$return['TaskId']=$invoiceData['TaskId'];
			$tot=$invoiceData['Total'] - $invoiceData['TotalPaid'];
			if($tot == $Amount ){


				$fData['TotalPaid']=$invoiceData['Total'];
				$fData['Paid']=1;
				$fData['PartiallyPaid']=0;
				$fData['DateOfPaymentToAgency']=\Carbon::now()->toDateTimeString();


			}


			if($tot< $Amount )$debug=0;
			if($debug)$m1->MS_update($fData,$invoiceData['UniqId']);
		}

		//Entery Part of Invoice Tabele & Update Task_Invoice Table
		\MS\Core\Helper\Comman::DB_flush();

		$m2=new \B\IM\Model(self::$TableIdForSubLedger, $codeForTable );
		$m22=$m2->get();

		if($m22->count() > 0 ){

			$invoiceSubData=$m22->toArray();

			foreach ($invoiceSubData as  $value) {
				
				\MS\Core\Helper\Comman::DB_flush();
				$m3=new \B\IM\Model(self::$TableIdForInvoice ,$invoiceData['TaskId']);

					//dd($value);
				$m33=$m3->where('UniqId', $value['UniqId'])->get();
				if($m33->count() > 0){


					$InvoiceMasterData=$m33->first()->toArray();
					$fData=[
						'CurrentStatus'=>'333'
					];
					if($debug)$m3->MS_update($fData,$InvoiceMasterData['UniqId']);
					//dd($InvoiceMasterData);
				}
		

			}


		}

		return $return;

	}


	public static function changePaymentStatus($data){


		$invoiceData=$data['invoiceData'];

		$codeForTable=$data['codeForTable'];
		$status=$data['Status'];

		$m2=new \B\IM\Model(self::$TableIdForSubLedger, $codeForTable );
		$m22=$m2->get();

		if($m22->count() > 0 ){

			$invoiceSubData=$m22->toArray();

			foreach ($invoiceSubData as  $value) {
				
				\MS\Core\Helper\Comman::DB_flush();
				$m3=new \B\IM\Model(self::$TableIdForInvoice ,$invoiceData['TaskId']);

					//dd($value);
				$m33=$m3->where('UniqId', $value['UniqId'])->get();
				if($m33->count() > 0){


					$InvoiceMasterData=$m33->first()->toArray();
					$fData=[
						'CurrentStatus'=>$status
					];
					if($debug)$m3->MS_update($fData,$InvoiceMasterData['UniqId']);
					//dd($InvoiceMasterData);
				}
		

			}


		}
		return true;


	}

	public static function addPartialPaymentToInvoiceId($InvoiceId,$AgencyCode){
		
	}

	// public static function addPaymentToInvoiceId($InvoiceId,$AgencyCode){
		
	// }



}