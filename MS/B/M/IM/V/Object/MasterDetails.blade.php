<div class="panel panel-default">
	
<div class="panel-heading"><h5><strong> <i class="glyphicon glyphicon-home"></i> IM Module Home</strong></h5></div>
<div class="panel-body">


<div class="col-lg-12">





<table class="table table-bordered">
	

<tr class="ms-table-heading-tr">
		
		<th>Task Id</th>
		<th>Name of Invoice</th>
		<th>Amount</th>
		<th>View</th>
	

</tr>


<?php

$data['dataM']=[];
$TaskArray=[];
$invoiceArray=[];
\MS\Core\Helper\Comman::DB_flush();
$id=1;
        $m1=new \B\TMS\Model(7);
     //   dd($m1->where('HasInvoice',1)->get()->count());


        if($m1->where('HasInvoice',1)->get()->count() > 0 )$TaskArray=$m1->where('HasInvoice',1)->get()->groupBy('UniqId')->toArray('UniqId');


       // dd($TaskArray);

        foreach ($TaskArray as $key => $value) {
        	\MS\Core\Helper\Comman::DB_flush();

        	$value=reset($value);
        	//dd($m1);
			$connection=\B\IM\Base::getConnection($id);
			$tableName=\B\IM\Base::getTable($id,$value['UniqId']);

        	if(\B\IM\Model::checkTableinDB($connection,$tableName)){

        		$m1=new \B\IM\Model($id,$value['UniqId']);
        		
        		if ($m1->get()->count() > 0 )$invoiceArray[$value['UniqId']] =$m1->get()->toArray();
        	}
        }

    //    dd($invoiceArray);


//dd(collect($data['dataM'][$key])->groupBy('StepId')->toArray());
?>

@if(count($invoiceArray)>0)
@foreach($invoiceArray as $key=>$value)

<tr>
<td class="ms-help" rowspan="{{ count($value)+1 }}" title="Piracy Network: {{ reset($TaskArray[$key])['NameOperator'] }} &#13;Agency Name: {{ \B\AMS\Logics::getAgencyName(reset($TaskArray[$key])['HireAgencyCode']) }} " >{{$key}}   </td>

</tr>

@foreach ($value as $key1=>$value1)
@if($loop->first )
<?php $total=0; ?>
@endif
<tr>

		<td>{{ explode(".",$value1['NameofDocument'])[0] }} </td>
		<td>{{   $value1['Amount']  }}</td>
		<td> <a class="btn btn-default" href="{{ route('TMS.Task.Get.File.Name',['UniqId'=>\MS\Core\Helper\Comman::en4url($value1['UniqId']),'TaskId'=>\MS\Core\Helper\Comman::en4url($key),'StepId'=>\MS\Core\Helper\Comman::en4url($value1['StepId']),'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($value1['TypeOfDocument']),'FileName'=>$value1['NameofDocument']]) }}" target="_BLANK"><i class="fa fa-paperclip"></i> {{ explode(".",$value1['NameofDocument'])[0] }}</a> </td>

</tr>
<?php $total=$total + $value1['Amount'] ?>
@if($loop->last)
<tr class="success">
	<th colspan="3" class="text-right">Total for Task ID: {{$key}} </th>
	<td colspan="1" class="text-right">{{ $total }}</td>
</tr>
@endif
@endforeach



@endforeach

@endif


</table>




</div>

</div>


</div>