<?php
$class="col-lg-6";
if(array_key_exists('index', $data))$index=(string)$data['index'];
if(!array_key_exists('vName', $data))$data['vName']=$data['lable'];

if(array_key_exists('ClassData',$data)){



if(array_key_exists('form-class-div',(array)$data['ClassData']))$class=$data['ClassData']['form-class-div'];
}else{
$class="col-lg-6";

}



if(array_key_exists('data', $data)){
		
		if(array_key_exists('input-size', $data['data']))$class= $data['data']['input-size'];

}
?>
<div class="form-group {{$class}}">
{{ Form::label($data['name'],$data['lable']) }} 

<div class="radio">
<?php //	dd($data); ?>




@foreach($data['dataArray'] as $value=>$lable)
<label tabindex="{{$index}}" class="form-conrtol">


	@if ($value == $data['value'])
		@if(array_key_exists('value',$data))
		{{Form::radio($data['name'], $value,true,['id'=>$data['name'].$loop->iteration])}}
		@else
		{{Form::radio($data['name'], $value,null,['id'=>$data['name'].$loop->iteration])}}
		@endif
	@else


    {{Form::radio($data['name'], $value,null,['id'=>$data['name'].$loop->iteration])}}
   
	@endif
	 {{$lable}}
  	
  </label>
@endforeach

</div>
</div>

