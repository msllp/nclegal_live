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






<div class="form-group {{ $class }}" >
<?php echo $req;?> 

{{ Form::label($data['name'], $data['vName'],['class'=>'control-label']) }}


 <div class="input-group">

      {{ Form::password($data['name'],['class'=>'form-control col-md-8','tabindex'=>$index,'placeholder'=>'Enter '.$data['lable'], 
    
    ]
     ) }}

     <div class="input-group-addon btn ms-btn-password-visible "  ms-target="{{$data['name']}}" ><i class="fa fa-eye-slash" id="{{$data['name']}}Icon"></i></div>
     </div>

 </div>

