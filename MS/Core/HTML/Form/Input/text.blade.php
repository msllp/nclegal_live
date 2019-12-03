<?php
$class="col-lg-6";
if(array_key_exists('index', $data))$index=(string)$data['index'];
if(!array_key_exists('vName', $data))$data['vName']=$data['lable'];

if(array_key_exists('ClassData',$data)){

if(array_key_exists('form-class-div',$data['ClassData']))$class=$data['ClassData']['form-class-div'];

}else{
$class="col-lg-6";

}


$attr='';
$req="<i class='fa fa-toggle-off text-danger' aria-hidden='true'></i>";
if(array_key_exists('data', $data)){
		
		if(array_key_exists('input-size', $data['data']))$class= $data['data']['input-size'];

		if(array_key_exists('required', $data['data'])){$attr.= 'required';$req="<i class='fa fa-toggle-on text-success' aria-hidden='true'></i>";}

}


?>

<div class="form-group has-feedback {{$class}} ">


	@if(array_key_exists('link',$data))


	<?php

	

	$class="\\B\\".$data['link']['mod']."\\Model";

	$class=new $class ();


    if(substr($data['name'], -1) == ']'){

    	$data['funName']=substr($data['name'], 0, -2);

    }else{

    	$data['funName']=$data['name'];


    }
	//$data['vName']=$data['name'];
    if(array_key_exists('funName', $data))
    {
    	$function="get".$data['funName'];
     	$dlist=$class->$function ();

	

    
    }



	?>


		@if(isset($dlist))

		<datalist id="{{$data['name']}}List">
			@foreach($dlist as $value=>$key)
		 <option value="{{$value}}"> {{$key}}</option>

			@endforeach

			
			</datalist>

		@endif


	@elseif(array_key_exists('search',$data))	

		<datalist id="{{$data['name']}}List" class="ms-live-data-load" ms-live-link="{{ route('MSCDN.search.Task.get.Data')}}">

		</datalist>

	@endif





<?php echo $req;?>  {{ Form::label($data['name'], $data['vName'],['class'=>'control-label']) }}
   
@if(array_key_exists('editLock',$data))


	@if( $data['editLock']  )


 <fieldset disabled> 

 					 @if($attr!='')
						{{ Form::text($data['name'],$data['value'],['class'=>'form-control','tabindex'=>$index,'readonly','required','placeholder'=>'Enter '.$data['vName']] ) }}
					 @else
						{{ Form::text($data['name'],$data['value'],['class'=>'form-control','tabindex'=>$index,'readonly','placeholder'=>'Enter '.$data['vName']] ) }}
					 @endif


 
 <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
 </fieldset>



	{{Form::hidden($data['name'], $data['value'])}}

@endif	


@else






     	@if($attr!='')
			{{ Form::text($data['name'], $data['value'],['class'=>'form-control','list'=>$data['name'].'List','tabindex'=>$index,'placeholder'=>'Enter '.$data['lable'],'required', ]) }}
		@else
			{{ Form::text($data['name'], $data['value'],['class'=>'form-control','list'=>$data['name'].'List','tabindex'=>$index,'placeholder'=>'Enter '.$data['lable'], ]) }}
	    @endif

@endif	

</div>

