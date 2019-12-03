<?php
namespace B\ADMS;


use \MS\Core\Module\MasterModule\MasterModel;

class Model extends MasterModel
{

protected $table;
protected $connection;
protected $fillable;
protected $base_Field;
protected $namespace;


    public function __construct($id=false,$code=false,$connection=false)
    {

        $this->namespace=__NAMESPACE__;

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



    public static function getColumnName($data=[]){
        $id=0;
        $code=null;
        if(array_key_exists('code', $data) || ($code !='' &&  $code !=null ))
        $code=$data['code'];

    if(isset($code) && ($code !='' &&  $code !=null )){

            $model=new Model($id,$code);

    }else{

            $model=new Model($id);
    }
                
    }
    




}