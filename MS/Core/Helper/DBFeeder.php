<?php 
namespace MS\Core\Helper;



class DBFeeder{




	public static function CreateTask($data=[]){

		$faker=\Faker\Factory::create();


		if (count($data) < 1) {
			


				\MS\Core\Helper\Comman::DB_flush();	
		$m1=new \B\AMS\Model();

		$agency=$m1->MS_all()->pluck('UniqId')->toArray();

		$hireAgencyCode=$agency[array_rand($agency, 1)];


		\MS\Core\Helper\Comman::DB_flush();	
		$uniqid=\B\TMS\Base::genUniqID();
		$m2=new \B\TMS\Model();

		$rData=[
					'UniqId'=>$uniqid,
		            'HireAgencyCode'=>$hireAgencyCode,
		            'NameOperator'=>$faker->bs,
		            'NameOwner'=>$faker->name,
		            'NameAreaPiracyCity'=>$faker->city,
		            'NameAreaPiracyDistrict'=>$faker->citySuffix,
		            'NameAreaPiracyState'=>$faker->state,
		            'NameAreaPiracyPincode'=>$faker->postcode,
		            'IllegalTypeBroadcasting'=>"FTA Network/LOC",
		            'StatusOperator'=>"FTA Network/LOC",
		            'NameOfNetwork'=>$faker->bs,
		            'NameOperatorAddress1'=>$faker->streetAddress,
		            'NameOperatorCity'=>$faker->city,
		            'NameOperatorDistrict'=>$faker->citySuffix,
		            'NameOperatorState'=>$faker->state,
		            'NameOperatorPincode'=>$faker->postcode,
		            'ModePiracy'=>'111',
		            'Status'=>true,
		            'CurrentStatus'=>0,
		            'HasInvoice'=>0,
		            'ReadStatus'=>0,
		            'ReadUserCode'=>collect([session('user.userData.UniqId')])->toJson(),
		            'ReadUserArray'=>collect(

				[ 
				
				session('user.userData.UniqId')=>
				[ 'UserCode'=>session('user.userData.UniqId'),
				  'Timestamp'=>\Carbon::now()->toDateTimeString(), ]


				])->toJson(),
		            ];

		$m2->MS_add($rData);

		$returnData=\B\TMS\Base::migrate([['id'=>'1','code'=>$uniqid]]);


		$rData=		

					[

					'UniqId'=>\B\TMS\Base::genUniqID(),

					'TypeOfAction'=>'0',

					'DocumentUploaded'=>false,

					'DocumentArray'=>collect([])->toJson(),

					'DocumentVerified'=>false,

					'DocumentVerifiedArray'=>collect([])->toJson(),

					'VerifiedBy'=>'0',

					'TakenBy'=>session('user.userData.UniqId'),

					];


			\MS\Core\Helper\Comman::DB_flush();

			$m3=new \B\TMS\Model('1',$uniqid);
			//dd($model2);
			$m3->MS_add($rData,$returnData['id'],$uniqid);



		//dd($hireAgencyCode);



		}

	


		
	}



	public static function CreateAgenecgy($data=[]){



		

		$faker=\Faker\Factory::create();

		

		$agencyName=$faker->bs;
		$userName='';
		$password='';

		$tableId=0;
		$namespace="\B\AMS";
		$mNameSpace=$namespace."\Model";

		foreach (explode(' ', $agencyName) as $key => $value) {
				
				$userName.=$value[0];
				$password.=strtolower($value[0]);

		}

		$userName.="admin";
		$password.="admin123";

		$base=$namespace."\Base";

		$UniqId=$base::genUniqID();
		$rData=[

			'UniqId'=>$UniqId,
            'Name'=>$agencyName,
            'AddressLine1'=>$faker->streetAddress,
            'AddressLine2'=>null,
            'AddressLine3'=>null,
            'Landmark'=>$faker->streetName,
            'City'=>$faker->city,
            'State'=>$faker->state ,
            'Pincode'=>$faker->postcode,
            'Username'=>$userName,
            'Password'=>\MS\Core\Helper\Comman::en($password),
            'AttName'=>$faker->firstName." ".$faker->lastName,
            'AttConatctNo'=>$faker->e164PhoneNumber,
            'AttEmail'=>$faker->safeEmail,
           'AllocatedJobs'=>collect([])->toJson(),
            'Status'=>1


		];

		//dd($rData);



		//if(array_key_exists('Password', $rData))$rData['Password']=\MS\Core\Helper\Comman::en($rData['Password']);


		$model=new $mNameSpace($tableId);
		$model->MS_add($rData,$tableId);
		\B\ANMS\Base::migrate([ 
					[
					'id'=>1,
					'code'=>$rData['UniqId']
					]
							]);
	

	}






}

