

	<?php
$class="col-lg-6";


if(array_key_exists('index', $data))$index=(string)$data['index'];

if(!array_key_exists('vName', $data))$data['vName']=$data['lable'];


$attr='';
$req="<i class='fa fa-toggle-off text-danger' aria-hidden='true'></i>";
if(array_key_exists('ClassData',$data)){




if(array_key_exists('form-class-div',$data['ClassData']))$class=$data['ClassData']['form-class-div'];

}else{
$class="col-lg-6";

}



if(array_key_exists('data', $data)){
		
		if(array_key_exists('input-size', $data['data']))$class= $data['data']['input-size'];
		if(array_key_exists('required', $data['data'])){$attr.= 'required';
				$req="<i class='fa fa-toggle-on text-success' aria-hidden='true'></i>";}
}
	?>

<div class="form-group {{ $class }}" >

<?php echo $req;?> 
    {{ Form::label($data['name'],$data['vName']) }}
   
    @if($attr!='')
    {{ Form::number($data['name'], $data['value'],['class'=>'form-control','tabindex'=>$index,'required','placeholder'=>'Enter '.$data['lable']] ) }}
    @else

    {{ Form::number($data['name'], $data['value'],['class'=>'form-control','tabindex'=>$index,'placeholder'=>'Enter '.$data['lable']] ) }}


    @endif

</div>