<?php
namespace B\NMS;

class Model extends \Illuminate\Database\Eloquent\Model
{

protected $table;
protected $connection;
protected $fillable;
protected $base_Field;


    public function __construct($id=false,$code=false,$connection=false)
    {

        if($id){    
            $this->id=$id;

            session(['MSID'=>$id]);

            if($code){ $this->table=Base::getTable($id).$code;session(['MSCODE'=>$code]);}else{$this->table=Base::getTable($id);}
            if($connection){$this->connection=$connection;}else{$this->connection=Base::getConnection($id);}
            $this->base_Field=Base::getField($id);

        }else
        {

            
            if(session('MSID')!=null){

            if(session('MSCODE')!=null){

                    $this->table=Base::getTable(session('MSID')).session('MSCODE');
            }else{

              $this->table=Base::getTable(session('MSID'));  
            }
            
            $this->connection=Base::getConnection(session('MSID'));
            $this->base_Field=Base::getField(session('MSID'));


            }else{

            $this->table=Base::getTable();
            $this->connection=Base::getConnection();
            $this->base_Field=Base::getField();
            }
           

        }
        
     
        foreach ($this->base_Field as $key => $value) {
            $this->fillable[]=$value['name'];
        }
        $this->fillable[]='id';

        
        
    }


     public function getTypeofDocumentById($code){
        

        $m=new Model(1);
       // dd($code);
        //dd($m->where('UniqId',$code)->first()->toArray()['UserName']);
        $u=$m->where('UniqId',$code)->first();
        if($u==null){
            return null;
        }else{

             return $m->where('UniqId',$code)->first()->toArray()['NameOfTypeOfAction'];
        }


    }
    public static function getCompanyName(){
        $model=new Model(1);

        $data=$model->get()->toArray();

        $last=count($data)-1;
        
        return $data[$last]['NameOfBussiness'];



    }
    


    public function genuniqid(){
        return Base::genUniqID();
    }



    public function MS_all(){

        $row=$this->all();
        return $row;
    }

    public function MS_delete($data,$id){
        \MS\Core\Helper\Comman::DB_flush();
        $row=new Model($id);
        //dd($row); 
        //dd($data);
        $row=$row->where('UniqId',$data['UniqId']);
        
        //if(\Storage::cloud()->exists($row->Attachments))\Storage::cloud()->delete($row->Attachments);
        //dd($row); 
        $row->delete();

        \MS\Core\Helper\Comman::DB_flush();

        return ['status'=>'200','msg'=>"Data Succesfully removed from MSDB."];
    }


    public function MS_Check_Last($id,$current){

        $model=new Model($id);

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

        if(array_key_exists('_token', $data))unset($data['_token']);
        

       // if(!array_key_exists('created_at', $data))$data['created_at']=\Carbon::now()->toDateTimeString();
        if(!array_key_exists('updated_at', $data))$data['updated_at']=\Carbon::now()->toDateTimeString();

        $data2=\DB::connection($this->connection)->table($this->table)->where('UniqId',$UniqId)->update($data);
      // dd($UniqId);
       // dd(\DB::connection($this->connection)->table($this->table)->where('UniqId',$UniqId)->get()   );
          \MS\Core\Helper\Comman::DB_flush();
   
        return ['status'=>'200','msg'=>"Data Succesfully added to MSDB."];

    }



    public function MS_add($data,$id=null,$uniqId=null){

         if(array_key_exists('_token', $data))unset($data['_token']);
         if(!array_key_exists('UniqId', $data))$data['UniqId']=Base::genUniqID();

        if(!array_key_exists('created_at', $data))$data['created_at']=\Carbon::now()->toDateTimeString();
        if(!array_key_exists('updated_at', $data))$data['updated_at']=\Carbon::now()->toDateTimeString();
        //dd($this);
       // dd($this->table);


        $data2=\DB::connection($this->connection)->table($this->table)->insertGetId($data);

        return ['status'=>'200'];
        // dd($data2);


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