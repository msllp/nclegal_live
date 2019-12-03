
	\B\IM\Base::migrate([['id'=>'2']]);
\MS\Core\Helper\Comman::DB_flush();
	$m=new \B\IM\Model(2);

	$data=[

		'000'=>'approved',
		'111'=>'forwarded to STAR',
		'222'=>'approved by STAR',
		'333'=>'paid'

	];
	
	foreach ($data as $key => $value) {
				$m->MS_add([
					'UniqId'=>$key,
					'NameOfStatus'=>$value,
					
				]);


		}	