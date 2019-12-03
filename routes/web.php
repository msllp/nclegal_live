<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::prefix('admin')->group(function () {	
	
Route::get('/', function () {
return redirect()->action('\B\Panel\Controller@index');	
});
  MS\Core\Helper\Comman::loadBack();

});



Route::prefix('agency')->group(function () {
	


	Route::get('/', function () {
	return redirect()->action('\B\APanel\Controller@index');	
	});

	$arrayForRoute=[

		'locationOfFile'=>'B.M.AgencyRoute',


	];
	MS\Core\Helper\Comman::loadCustom($arrayForRoute);



  MS\Core\Helper\Comman::loadBack();

});






Route::get('/', function () {

	return view('B.L.Pages.LandingPage');
return redirect()->action('\B\APanel\Controller@index');	
});


Route::get('/', function () {

	return view('B.L.Pages.LandingPage');
	
	//return redirect()->action('\B\APanel\Controller@index');	
});



Route::get('/migrate', function () {

		

	//return redirect()->action('\B\APanel\Controller@index');	
});


use Yajra\DataTables\Html\Builder;
Route::get('/test', function (Builder $builder) {

		$m=new \B\TMS\Model(7);

	    if (request()->ajax()) {
        return Datatables::of($m->get()->map(function ($user){
    $user->HireAgencyCode = \B\AMS\Logics::getAgencyName($user->HireAgencyCode);
   //$user->created_at_string = \Carbon::parse($user->created_at)->format('d/m/Y');
  $user->created_at_string=$user->created_at->format("Y/m/d");
  $user->CurrentStatus=\B\TMS\Logics::getTypeOfAction($user->CurrentStatus)['NameOfAction'];
    	return $user;
    }));

}
    $html = $builder->columns([
                ['data' => 'created_at_string', 'name' => 'created_at_string', 'title' => 'From'],
                ['data' => 'UniqId', 'name' => 'UniqId', 'title' => 'ID'],
                ['data' => 'HireAgencyCode', 'name' => 'HireAgencyCode', 'title' => 'Agency'],
                ['data' => 'NameOperator', 'name' => 'NameOperator', 'title' => 'Name of Operator At'],
                ['data' => 'ModePiracy', 'name' => 'ModePiracy', 'title' => 'Mode of Piracy At'],
    			['data' => 'CurrentStatus', 'name' => 'CurrentStatus', 'title' => 'Current Status'],

            ]);

dd( $html);
	return view("L.Pages.ListWidget");

	
});

Route::get('/ajax', function () {
$m=new \B\TMS\Model(7);

	
	//return Datatables::of($m->get())->make(true);	
return Datatables::of($m->get()->map(function ($user){
    $user->HireAgencyCode = \B\AMS\Logics::getAgencyName($user->HireAgencyCode);
   //$user->created_at_string = \Carbon::parse($user->created_at)->format('d/m/Y');
  $user->created_at_string=$user->created_at->format("Y/m/d");
  $user->CurrentStatus=\B\TMS\Logics::getTypeOfAction($user->CurrentStatus)['NameOfAction'];
    //dd(\Carbon::parse($user->created_at)->format('d-m-Y'));
    return $user;
}))->orderByNullsLast()->make(true);

	
})->name('test.ajax');



  //MS\Core\Helper\Comman::loadFront();


Route::get('/test/agent/{text}', function ($text) {

	$status=200;
					$array=[
					'msg'=>$text,
			 		

				];

	
				 return response()->json($array, $status);

});

Route::get('/test/agent/location', function () {

	$status=200;
					$array=[
					'msg'=>[ 'Please select all to upload.' ],
			 		

				];

	
				 return response()->json($array, $status);

});




