<?php
namespace MS\Core\Module\MasterModule;


abstract class MasterBase{





public static  function genFormData($edit=false,$data=[],$id=false,$perFix=null){
	
	$array=[];
	if($edit and count($data)>0){

		$mString=static :: $model;

		if($perFix == null){
$model=new $mString($id);
		}else{
$model=new $mString($id,$perFix);
		}
		
			
		//dd($model);
		
		if(gettype($data) == 'object')$data=$data->toArray();


		

		$v=$model->where(array_keys($data)[0],$data[array_keys($data)[0]])->first();

		if($v!=null){
			$v=$v->toArray();
		}
		//dd($v);

		if($id){
		
				$field="field".$id;
				foreach (static::$$field as $value) {
				
				//var_dump($value);
				if(array_key_exists($value['name'], $v)){

					$value['value']=$v[$value['name']];		
				
				}

				$data=static::genFieldData($value);
					
				$unset=['default'];
				foreach ($unset as $value1) {
						unset($data[$value1]);
					}

				if($data!=null and count($data)>2)$array[]=$data;	
			}
			


			}else{

				foreach (static::$field as $value) {

				//if(array_key_exists('callback', $value))unset($value['callback']);
				$value['value']=$v[$value['name']];
				//$test[]=$value;
				$data=static::genFieldData($value);
				if($data!=null)$array[]=static::genFieldData($value);	
				}
			}

		
		if(count($data)==1){

	

			
		}

		
		
			
	}else{

		if($id){
			$field="field".$id;
			foreach (static::$$field as $value) {
				$data=static::genFieldData($value);
				if($data!=null)$array[]=static::genFieldData($value);		
				}


		}else{

				foreach (static::$field as $value) {
				$data=static::genFieldData($value);
				if($data!=null)$array[]=static::genFieldData($value);		
				}


		}
		

	}

	
	return $array;
}


public static function genUniqID (){
	//if($this->where(''))
	return \MS\Core\Helper\Comman::random(2,1);
}


public static function getTable($id=false,$code=null){
	

	if($id){
		$table='table'.$id;


		if($code!=null){
			$return =static::$$table;
			return $return .$code;
		}

		return static::$$table;
		}else{
			return static::$table;
			
		
	}
}

public static function getTableStatus($id=false){
	if($id){
		$table='tableStatus'.$id;

		return static::$$table;
		}else{
			return static::$tableStatus;
			
		
	}
}

public static function getConnection($id=false){
	if($id){

		if(static::$allOnSameconnection){
			$connection='connection';
			}else{
			$connection='connection'.$id;
			}

		if(isset(static::$$connection))
		return static::$$connection;
		return static::$connection;
		}else{
		return static::$connection;
	}
}

public static function getField($id=false){
	if($id){
		
		$field='field'.$id;
		return static::$$field;
	}else{
	return static::$field;	
	}
	
}


public static function seed(){
	return \DB::connection(static::getConnection())->table(static::getTable());
}

public static function migrate($data=[]){
	
			
			if(count($data)>0){

				
				foreach ($data as $key => $value) {
							
							if(array_key_exists('id', $value)){

								$id=$value['id'];
								$table=static::getTable($id);
								$field=static::getField($id);	


								if(array_key_exists('code', $value)){

									$table.=$value['code'];

								}
								
								if(static::$allOnSameconnection){
								$connection=static::getConnection();
								}else{
								$connection=static::getConnection($id);	
								}



								if(!\Schema::connection($connection)->hasTable($table)){
								
								\MS\Core\Helper\Comman::makeTable($table,$field,$connection);



								}


								return [

									'id'=>$id,
									'tableName'=>$table,
									'connection'=>$connection,
								];
								
							}


			

				}						


			}else{

			$tableNo=self::$tableNo;
			$tableName="table";
			$fieldName="field";
			$connectionName="connection";

			for ($i=0; $i < $tableNo+1 ; $i++) { 
			
			$id=$i;
			$table=static::getTable($id);
			$field=static::getField($id);

			if(static::$allOnSameconnection){
			$connection=static::getConnection();
			}else{
			$connection=static::getConnection($id);	
			}

			if(static::getTableStatus($id))\MS\Core\Helper\Comman::makeTable($table,$field,$connection);
			

			}


			

			

		}

}

public static function rollback($data=[]){


	if(count($data)>0){


				
				foreach ($data as $key => $value) {
							
							if(array_key_exists('id', $value)){

								$id=$value['id'];
								$table=self::getTable($id);
								


								if(array_key_exists('code', $value)){

									$table.=$value['code'];

								}
								
								if(self::$allOnSameconnection){
								$connection=self::getConnection();
								}else{
								$connection=self::getConnection($id);	
								}


								\MS\Core\Helper\Comman::deleteTable($table,$connection);
								
							}


			

				}						


			}
		

	
}






public static function genFieldData($data){
	$array=[];

	if (array_key_exists('value', $data)) {
		if($data != null){
			$value=$data['value'];
		}
	}
//dd($data);
	switch ($data['input']) {
		case 'text':

			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			];
			if (array_key_exists('link', $data)) {
				$array['link']=[

				'mod'=>explode(':', $data['link'])[0] ,
			

			];
			}
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];

			break;

		case 'email':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			'default'=>(array_key_exists('default', $data) ? static::$data['default']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;

		case 'number':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;
		case 'option':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'data'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('editLock', $data))$array['editLock']=$data['editLock'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;

		case 'disable':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;


		case 'radio':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			'data'=>(array_key_exists('default', $data) ? static::$data['default']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;

		case 'check':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;

		case 'password':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;


			case 'textarea':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;

			case 'auto':
			if(array_key_exists('hidden', $data)){
				if ($data['hidden']) {
					$data['input']='hidden';
				}
			}
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			//'value'=>(array_key_exists('callback', $data) ? self::$data['callback']() : null),
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;

			case 'date':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;

			case 'file':
			$array=[
			'lable'=>ucfirst($data['name']),
			'name'=>$data['name'],
			'type'=>$data['input'],
			'value'=>(array_key_exists('callback', $data) ? static::$data['callback']() : null),
			];
			if(array_key_exists('vName', $data))$array['vName']=$data['vName'];
			if(array_key_exists('data', $data))$array['data']=$data['data'];
			break;
		

		default:
			# code...
			break;
	}

	if(isset($value)){
		$array['value']=$value;
		if($array['value']=='array'){
			$array['value']='';
		}
	}

	$lable=preg_split('/(?=[A-Z])/',ucfirst($data['name']));
	unset($lable[0]);
	(count($lable) >= 2 ? $array['lable']=implode(' ', $lable) : null );

	return $array;
}
public static function decode($UniqId){
	$UniqId=str_replace('_','/',$UniqId);
	return $UniqId;
}


public static function enode($UniqId){
	$UniqId=str_replace('/','_',$UniqId);
	return $UniqId;
}


}


