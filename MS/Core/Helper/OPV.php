<?php
namespace MS\Core\Helper;


class OPV {


public static $Masterdirectory='MS'.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'JS'.DIRECTORY_SEPARATOR;


public static function validPrint($rules){

	$jsString=[];
	$rulesData=[];


	foreach ($rules as $key => $value) {
		
		$rulesData[$key]=explode('|', $value);

		foreach ($rulesData[$key] as $key1 => $value1) {
			
			switch ($value1) {
					case 'required':
						$file=self::$Masterdirectory."Required.php";
						$dv=[];
						$jsString[]=self::getJs($dv,$file);
						break;
					
					default:
						# code...
						break;
				}	


		}
	}

	return implode(' ', $jsString);



}


 public static function getJs($dv,$file)
    {
    	//dd($file);
    	$file=file_get_contents(base_path($file));

    	foreach ($dv as $key => $value) {
    		$file=str_replace($key, $value,$file);
    	}

    	return $file;
    	//str_replace("%body%", "black", "<body text='%body%'>");
    	//dd($file);

    }


}