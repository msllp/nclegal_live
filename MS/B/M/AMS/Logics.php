<?php
namespace B\AMS;

class Logics{


	public static function getUserName($UniqId){



		$m=new Model();
		return $m->getHireAgencyCodeFromId($UniqId);
	}


	public static function getAgencyName($UniqId){



		$m=new Model();
		return $m->getHireAgencyCodeFromId($UniqId);
	}

	public static function getAgancyCode($UniqId){

			$m=new Model();
		return $m->getAgencyCodeFromName($UniqId);
	}



	public static function getTotalAgency(){
		$m=new Model(1);
		return $m->where('Status',1)->get()->count();

	}

	public static function getAgency($AgencyCode){

			$m=new Model(1);
			//dd($AgencyCode);
			//dd($m->where('UniqId',$AgencyCode)->get());
			$m1=$m->where('UniqId',$AgencyCode)->get();

			if($m1->count() < 1)return [];

			return $m1->first()->toArray();


	}
	



	
}