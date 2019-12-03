<?php
namespace B\Users;

class Model extends \Illuminate\Database\Eloquent\Model
{

protected $table;
protected $connection;
protected $fillable;
protected $base_Field;


	public function __construct()
    {
        $this->table=Base::getTable();
        $this->connection=Base::getConnection();
        $this->base_Field=Base::getField();
     
        foreach ($this->base_Field as $key => $value) {
        	$this->fillable[]=$value['name'];
        }

        
        
    }

    public function getUserNameById($code){

        $m=new Model();
        //dd($m->where('UniqId',$code)->first()->toArray()['UserName']);
        $u=$m->where('UniqId',$code)->first();
        if($u==null){
            return null;
        }else{

             return $m->where('UniqId',$code)->first()->toArray()['UserName'];
        }


       
        

    }

 



     public function getUserCodeById($code){

        $m=new Model();
        //dd($m->where('UniqId',$code)->first()->toArray()['UserName']);
        $u=$m->where('UniqId',$code)->first();
        if($u==null){
            return null;
        }else{

             return $m->where('UniqId',$code)->first()->toArray()['RoleCode'];
        }


       
        

    }

    public function genuniqid(){
        return Base::genUniqID();
    }


    public function MS_all(){
        $row=$this->all()->toArray();
        
        return $row;

    }

    public function MS_delete($data){
        $row=new Model();

        //dd($data);
        $row=$row->where('UniqId',$data['UniqId'])->first();
        //if(\Storage::cloud()->exists($row->Attachments))\Storage::cloud()->delete($row->Attachments);
        
        $row->delete();
        return ['status'=>'200','msg'=>"Data Succesfully removed from MSDB."];
    }

    public function MS_update($data){

        $row=new Model();
        $row=$row->where('UniqId',$data['UniqId'])->first();
        //dd($row);
          //  $data['AttachmentsArray']="array";
          //  if(!(array_key_exists('Attachments', $data)))$data['Attachments']="array";
            
             if(array_key_exists('_token', $data))unset($data['_token']);
       
        foreach ($data as $key => $value) {
            $row->$key=$value;
            
        }



        $row->save();
        return ['status'=>'200','msg'=>"Data Succesfully added to MSDB."];

    }

  public function MS_add($data,$id=0){
            
            if($id)
                {$row=new Model($id);}else{
                    $row=new Model();
                }
          //  $data['AttachmentsArray']="array";
           // if(!(array_key_exists('Attachments', $data)))$data['Attachments']="array";
             if(array_key_exists('_token', $data))unset($data['_token']);
             if(!array_key_exists('UniqId', $data))$data['UniqId']=Base::genUniqID();
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
}


