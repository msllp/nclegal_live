<?php 
namespace MS\Core\Helper;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');
class Comman {




	public static function DB_flush(){
         session(['MSID'=>null]);
         session(['MSCODE'=>null]);


    }

	public static function loadBack(){
		require_once(base_path('MS'.DIRECTORY_SEPARATOR .'B'.DIRECTORY_SEPARATOR .'M'.DIRECTORY_SEPARATOR ."Routes.php"));
	}

	public static function loadFront(){
		require_once(base_path('MS'.DIRECTORY_SEPARATOR .'F'.DIRECTORY_SEPARATOR .'M'.DIRECTORY_SEPARATOR ."Routes.php"));
	}



	public static function loadCustom($array=[]){

		if(count($array) > 0){

			// foreach ($array as $value) {
			// 	if($allArray==1){
			// 	(!gettype($value)=='array')?$allArray=0;	
			// 	}
			// }
			
			array_key_exists('locationOfFile', $array)?require_once(base_path('MS'.DIRECTORY_SEPARATOR .implode(DIRECTORY_SEPARATOR,explode('.', $array['locationOfFile'])).'.php')):null;


		}else{


		require_once(base_path('MS'.DIRECTORY_SEPARATOR .'F'.DIRECTORY_SEPARATOR .'M'.DIRECTORY_SEPARATOR ."Routes.php"));

		}
	}


	public static function loadRoute($module,$backend=true){
		if ($backend) {
			require_once(base_path('MS'.DIRECTORY_SEPARATOR .'B'.DIRECTORY_SEPARATOR .'M'.DIRECTORY_SEPARATOR .ucfirst($module).DIRECTORY_SEPARATOR."Routes.php"));
		}else{
			require_once(base_path('MS'.DIRECTORY_SEPARATOR .'F'.DIRECTORY_SEPARATOR .'M'.DIRECTORY_SEPARATOR .ucfirst($module).DIRECTORY_SEPARATOR."Routes.php"));
		}
	}


	public static function random($count,$type='1'){
	$randstring=[];
    switch ($type) {
    	case'patern':
    		$characters = '123';
    		break;

    	case '1':
    		$characters = '0123456789';
    		break;

    	case '2':
    		$characters = 'abcdefghijklmnopqrstuvwxyz';
    		break;

    	case '3':
    		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		break;

    	case '4':
    		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		break;


    	case '5':
    		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		break;
    	
    	default:
    		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		break;
    }
    

    for ($i = 0; $i <= $count; $i++) {
        $randstring[]= $characters[rand(0, strlen($characters)-1)];
    }
    return implode('', $randstring) ;
}
	
	

	public static function urlBase($splitCode,$patern,$reverse=false){



		$base=[
			
			'0'=>[
				'0'=>'a',
				'1'=>'b',
				'2'=>'c',
				'3'=>'d',
				'4'=>'e',
				'5'=>'f',
				'6'=>'g',
				'8'=>'h',
				'7'=>'j',
				'8'=>'k',
				'9'=>'l',
				"_"=>"_"

			],

			'1'=>[
				'0'=>'a',
				'1'=>'b',
				'2'=>'c',
				'3'=>'d',
				'4'=>'e',
				'5'=>'f',
				'6'=>'g',
				'8'=>'h',
				'7'=>'j',
				'8'=>'k',
				'9'=>'l',
				"_"=>"_"

			],
			'2'=>[
				'0'=>'m',
				'1'=>'n',
				'2'=>'o',
				'3'=>'p',
				'4'=>'q',
				'5'=>'r',
				'6'=>'s',
				'8'=>'t',
				'7'=>'u',
				'8'=>'v',
				'9'=>'w',
				"_"=>"_"

			],
			'3'=>[
				'0'=>'q',
				'1'=>'f',
				'2'=>'r',
				'3'=>'a',
				'4'=>'j',
				'5'=>'k',
				'6'=>'t',
				'8'=>'o',
				'7'=>'m',
				'8'=>'n',
				'9'=>'p',
				"_"=>"_"

			],

			'4'=>[
				'0'=>'q',
				'1'=>'f',
				'2'=>'r',
				'3'=>'a',
				'4'=>'j',
				'5'=>'k',
				'6'=>'t',
				'8'=>'o',
				'7'=>'m',
				'8'=>'n',
				'9'=>'p',
				"_"=>"_"

			],

			'5'=>[
				'0'=>'q',
				'1'=>'f',
				'2'=>'r',
				'3'=>'a',
				'4'=>'j',
				'5'=>'k',
				'6'=>'t',
				'8'=>'o',
				'7'=>'m',
				'8'=>'n',
				'9'=>'p',
				"_"=>"_"


			],


			'6'=>[
				'0'=>'q',
				'1'=>'f',
				'2'=>'r',
				'3'=>'a',
				'4'=>'j',
				'5'=>'k',
				'6'=>'t',
				'8'=>'o',
				'7'=>'m',
				'8'=>'n',
				'9'=>'p',
				"_"=>"_"

			],

			'7'=>[
				'0'=>'q',
				'1'=>'f',
				'2'=>'r',
				'3'=>'a',
				'4'=>'j',
				'5'=>'k',
				'6'=>'t',
				'8'=>'o',
				'7'=>'m',
				'8'=>'n',
				'9'=>'p',
				"_"=>"_"

			],


			'8'=>[
				'0'=>'q',
				'1'=>'f',
				'2'=>'r',
				'3'=>'a',
				'4'=>'j',
				'5'=>'k',
				'6'=>'t',
				'8'=>'o',
				'7'=>'m',
				'8'=>'n',
				'9'=>'p',
				"_"=>"_"

			],

			'9'=>[
				'0'=>'q',
				'1'=>'f',
				'2'=>'r',
				'3'=>'a',
				'4'=>'j',
				'5'=>'k',
				'6'=>'t',
				'8'=>'o',
				'7'=>'m',
				'8'=>'n',
				'9'=>'p',
				"_"=>"_"

			],

			'10'=>[
				'0'=>'q',
				'1'=>'f',
				'2'=>'r',
				'3'=>'a',
				'4'=>'j',
				'5'=>'k',
				'6'=>'t',
				'8'=>'o',
				'7'=>'m',
				'8'=>'n',
				'9'=>'p',
				"_"=>"_"

			],


		];

		if($reverse){	



			//dd(array_search($splitCode,$base[$patern]));
			return array_search($splitCode,$base[$patern]);
	
		}



	//	var_dump($base[$patern][$splitCode]);
		return $base[$patern][$splitCode];


	}

	
	public static function de4url($code){

	$splitCode=str_split($code);
	$patern=self::urlBase($splitCode[0],1,1);

	//var_dump($patern);
	//dd($patern);

	if(count($splitCode)>0)unset($splitCode[0]);
	$splitCode=str_split(implode('', $splitCode),2);
	$output=[];

		$count=0;
	foreach ($splitCode as  $value) {
		

		$row=str_split($value);

		//var_dump(self::urlBase($row[0],$patern,1));
		//var_dump($row[0]);

		$output[$count]=self::urlBase($row[1],$patern,1);


		$count++;
	}
	//dd($output);
	return implode('', $output);


	}

	public static function en4url($code){

		$splitCode=str_split($code);

	//	dd($splitCode);
		
		$patern=self::random(0,'patern');
		//dd($patern);
		
		$output[0]=self::urlBase($patern,1);
		//dd($output);
		//var_dump($output[0]);
		//$output='';
		$count=0;
		foreach ($splitCode as $key => $value) {
				//dd($value);

				if($count > 9){
					$count=0;
					$output[]=self::urlBase($count,$patern).self::urlBase($value,$patern);
				}else{
					$output[]=self::urlBase($count,$patern).self::urlBase($value,$patern);

				}
				
				//var_dump(self::urlBase($key,$patern).self::urlBase($value,$patern));
				$count++;
		}
		//var_dump( implode('', $output));
		//dd($output);
		return implode('', $output);

	}

	// Encrypt Function
	public static function en($encrypt, $key=ENCRYPTION_KEY){
	    $encrypt = serialize($encrypt);
	    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
	    $key = pack('H*', $key);
	    $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
	    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
	    $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
	    return $encoded;
	}
	// Decrypt Function
	public static function de($decrypt, $key=ENCRYPTION_KEY){
	    $decrypt = explode('|', $decrypt.'|');
	    $decoded = base64_decode($decrypt[0]);
	    $iv = base64_decode($decrypt[1]);
	    if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
	    $key = pack('H*', $key);
	    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
	    $mac = substr($decrypted, -64);
	    $decrypted = substr($decrypted, 0, -64);
	    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
	    if($calcmac!==$mac){ return false; }
	    $decrypted = unserialize($decrypted);
	    return $decrypted;
	}


    public static function makeColumn($table,$name,$type="string",$default=""){
         
         switch ($type) {
            case 'boolean':
               $table->boolean($name)->default(false);
               break;
            
            default:
               if($default !=""){

                  $table->string($name)->nullable();
               }else{
                  $table->string($name)->nullable();
               }               
               break;
         }
         
      }

    public static function makeTable($name,$array,$connection=""){
            if($connection!=""){
               Schema::connection($connection)->dropIfExists($name);
               Schema::connection($connection)->create($name, function (Blueprint $table)use ($array)  {



                $table->increments('id');



             foreach ($array as $value) {
                     
                     self::makeColumn($table,$value['name'],$value['type']);

                  }           
                  $table->timestamps();
              }); 
            }else
            {
            	Schema::dropIfExists($name);

            	
                  Schema::create($name, function (Blueprint $table) use ($array) {
                    $table->increments('id');
             foreach ($array as $value) {
                     
                     self::makeColumn($table,$value['name'],$value['type']);

                  }           
                  $table->timestamps();
              }); 
            }

            

      }

    public static function deleteTable($name,$connection=""){
       //   dd($name);
          if ($connection != "") {
          Schema::connection($connection)->dropIfExists($name);
          }else{
          Schema::dropIfExists($name);  
          }
          
      }


    public static function getYr(){return date('Y');}

    public static function getMon(){return date('m');}

    public static function getDay(){return date('d');}
    public static function getCDate(){return date("Y-m-d");}
    public static function getFDate($day=0){return date("Y-m-d",strtotime(date("Y-m-d")." +".$day." days"));}



    public static function loadModV($moduleCode,$file){

    }


	public static function loadModuleRoute($baseClass){
		
			$cl=$baseClass."\\"."Base";		
			$data=$cl::$routes;

			foreach ($data as $value) {
			if(!array_key_exists('type', $value))
			{

			}else{
				//$value['route']=strtolower($value['route']);
				switch ($value['type']) {
					case 'get':
						//\Route::get($value['route'],$cl::$controller."@".$value['method']);
						\Route::get($value['route'],$cl::$controller."@".$value['method'])->name($value['name']);
						break;

					case 'post':
						\Route::post($value['route'],$cl::$controller."@".$value['method'])->name($value['name']);
						break;

					case 'put':
						\Route::put($value['route'],$cl::$controller."@".$value['method']);
						break;

					case 'delete':
						\Route::delete($value['route'],$cl::$controller."@".$value['method']);
						break;
					
					default:
						# code...
						break;
				}
	}
		

		
	}

	}

	public static function findDuplicate($class,$cloumn,$value){


			$row=$class->where($cloumn,$value)->get()->toArray();
			//dd($row);
			//dd();

			if(collect($row)->isNotEmpty()){
				return ['error'=>true,'msg'=>"Duplicate Found"];
			}

			return ['error'=>false,'msg'=>"Duplicate Not Found"];

	}


		public static function toINR( $str ,$type='1',$data=[]){
		$return = '';
		$str=(String) $str;


		switch ($type) {
			case '1':
				
				$num=$str;
					
				$explrestunits = "" ;
			    if(strlen($num)>3) {
			        $lastthree = substr($num, strlen($num)-3, strlen($num));
			        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
			        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
			        $expunit = str_split($restunits, 2);
			        for($i=0; $i<sizeof($expunit); $i++) {
			            // creates each of the 2's group and adds a comma to the end
			            if($i==0) {
			                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
			            } else {
			                $explrestunits .= $expunit[$i].",";
			            }
			        }
			        $thecash = $explrestunits.$lastthree;
			    } else {
			        $thecash = $num;
			    }
			    


//			   $thecash="100,10,10,10,000";

			    if(array_key_exists('short', $data)){
			    if($data['short']){


			    	
			    	$amountArray=explode(',',$thecash);
			    	$amountCount=count($amountArray);
			    	
			    	//dd($amountArray);
			    	//dd($amountCount);
			    	//dd(($amountCount > 0 )&& ($amountCount < 2 ));
			    	if(($amountCount > 0 )&& ($amountCount < 2 ) ){
			    		$return=$thecash;
			    	}elseif ($amountCount < 3) {
			    		$return=$amountArray[0]." thousand ";
			    	} elseif($amountCount < 4 && $amountCount > 2 ) {
			    		$return=$amountArray[0].".".$amountArray[1]." lakh ";
			    	}

			    	 elseif($amountCount < 5 && $amountCount > 3 ) {
			    		$return=$amountArray[0].".".$amountArray[1]." crore ";
			    	}
			    	// elseif($amountCount < 6 && $amountCount > 4 ) {
			    	// 	$return=$amountArray[0]." lakh crore ";
			    	// }
			    	else{
			    		$return=$thecash;
			    	}
			    	
			    	return $return;

			    	
			    		


				}else {$return=$thecash;}
				    }else{

				    	$return=$thecash;

				    }





			    if(array_key_exists('symbol', $data)){
			    if($data['symbol']){$return="₹ ".$thecash;	}else {$return=$thecash;}
			    }else{

			    	$return=$thecash;

			    }

			   // dd($return);
			    
			    
				



				break;
			
		





			default:
				# code...
				break;
		}

		return $return;

	}




}