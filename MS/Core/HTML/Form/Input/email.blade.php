<?php
$class="col-lg-6";

if(array_key_exists('index', $data))$index=(string)$data['index'];
if(!array_key_exists('vName', $data))$data['vName']=$data['lable'];

if(array_key_exists('ClassData',$data)){




if(array_key_exists('form-class-div',$data['ClassData']))$class=$data['ClassData']['form-class-div'];

}else{
$class="col-lg-6";

}


$req="<i class='fa fa-toggle-off text-danger' aria-hidden='true'></i>";
if(array_key_exists('data', $data)){
		
		if(array_key_exists('input-size', $data['data']))$class= $data['data']['input-size'];
		if(array_key_exists('required', $data['data'])){$req="<i class='fa fa-toggle-on text-success' aria-hidden='true'></i>";}

}

?>
<div class="form-group {{$class}}">
   <?php echo $req;?>  {{ Form::label($data['name'], $data['vName']) }}
    {{ Form::email($data['name'], $data['value'],['class'=>'form-control','tabindex'=>$index,'placeholder'=>'Enter '.$data['lable']] ) }}
</div>