
<?php

if(array_key_exists('index', $data))$index=$index+$data['index'];


if(array_key_exists('ClassData',$data)){




if(array_key_exists('form-class-div',$data['ClassData']))
	$class=$data['ClassData']['form-class-div'];
}else{
$class="col-lg-6";

}
?>
<div class="form-group {{ $class }}">
<fieldset disabled>
{{ Form::label($data['lable'], $data['name']) }} 
 {{ Form::text($data['name'], reset($data['data']),['class'=>'form-control','tabindex'=>$index,'readonly','placeholder'=>'Enter '.$data['lable']] ) }}
</fieldset>


@if($data['editLock'])

@if(array_key_exists('value',$data))
{{Form::hidden($data['name'], $data['value'])}}
@endif
@endif


</div>

