<?php 
namespace MS\Core\Module\MasterModule;

use   \Illuminate\Database\Eloquent\Model;

class MasterModel extends Model {






	public function genuniqid(){
        return Base::genUniqID();
    }


    public function MS_all(){
        $row=$this->all();
        return $row;
    }

    public function MS_delete($data,$id,$dataArray=[]){


       if(count($data)!=1)return  ['status'=>'422','msg'=>"data Invalid Size"];

        if(!array_key_exists("UniqId", $data)){


            $m=new static($id); 
      
            $connection=$m->connection;

            $table=$m->table;

            
        }else{


            $uniEx=explode("_", $data['UniqId']);

            if(count($uniEx)>0)
            {

                 $m=new static($id,reset($uniEx)); 
            }else{

                 $m=new static($id,$data['UniqId']); 

            }
            
           
      
            $connection=$m->connection;

            $table=$m->table;

        }
        //dd($data['UniqId']);
        
        

        if(count($dataArray)==1){

            //dd( $table);

            $value=reset($dataArray);
            $column=key($dataArray);
            \DB::connection($connection)->table($table)->where($column,"=",$value)->delete();
            return ['status'=>'200','msg'=>"Data Succesfully removed from MSDB."];

        }


        dd( \DB::connection($connection)->table($table)->where('UniqId',"=",$data['UniqId'])->delete());


        return ['status'=>'200','msg'=>"Data Succesfully removed from MSDB."];
    }


    public function MS_Check_Last($id,$current){

        $model=new static($id);

        $formData=$model->get()->toArray();

        $last=count($formData)-1;
        $lastData=$formData[$last];

        $e=1;


         if(array_key_exists('_token', $current))unset($current['_token']);
          if(array_key_exists('UniqId', $current))unset($current['UniqId']);
       
        foreach ($current as $key => $value) {
            

        if(!($e && $lastData[$key]==$value))return true;

        }


        return false;

    }

    public function MS_update($data,$UniqId){
        $m=implode('\\', ['',$this->namespace,'Model']);


        if(array_key_exists('_token', $data))unset($data['_token']);
        if(!array_key_exists('updated_at', $data))$data['updated_at']=\Carbon::now()->toDateTimeString();

        $data2=\DB::connection($this->connection)->table($this->table)->where('UniqId',$UniqId)->update($data);
        \MS\Core\Helper\Comman::DB_flush();
   
        return ['status'=>'200','msg'=>"Data Succesfully added to MSDB."];
    }

    public function MS_add($data,$id=0){
            

            if($id===0)$id=$this->Ms_id;

            if($this->code!=null){
                $code=$this->code;
                //$model=new $mString($id);
            }



        
        $m=implode('\\', ['',$this->namespace,'Model']);
       // dd();
            if($id)
                {

                    if(isset($code)){ 
                    $row=new $m($id,$code);
                }else{
                    $row=new $m($id);
                }

                }else{
                    $row=new $m();
                }
          //  $data['AttachmentsArray']="array";
           // if(!(array_key_exists('Attachments', $data)))$data['Attachments']="array";
             if(array_key_exists('_token', $data))unset($data['_token']);
             if(!array_key_exists('UniqId', $data))$data['UniqId']=\B\Panel\Base::genUniqID();
             if(!array_key_exists('created_at', $data))$data['created_at']=\Carbon::now()->toDateTimeString();
             if(!array_key_exists('updated_at', $data))$data['updated_at']=\Carbon::now()->toDateTimeString();
        foreach ($data as $key => $value) {
            $row->$key=$value;
            
        }

        

        if($row->checkSave()['error']){
            return ['status'=>'200'];
        }
            return ['status'=>'200','msg'=>$row->checkSave()];
    }


    public function checkSave(){


         $error=\MS\Core\Helper\Comman::findDuplicate($this,'UniqId',$this->UniqId);
        // dd($error);
         if(!$error['error']){
            $this->save();
            $error=['error'=>false,'msg'=>"User Succesfully added to Database."];
            return $error;
         }
         return $error;
    }


     public function deleteTable(){
       \MS\Core\Helper\Comman::deleteTable($this->table,$this->connection);
    }

    public static function checkTableinDB($connection,$table){

        return \Schema::connection($connection)->hasTable($table);

    }

    public function checkCurrentTable(){

        $connection=$this->connection;
        $table=$this->table;

        return \Schema::connection($connection)->hasTable($table);


    }


    public function checkTableExist($id,$namespace){

        
        
    }
}