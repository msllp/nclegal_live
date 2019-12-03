<?php
	
	//	dd(\B\IM\Logics::getInvoiceByTaskId($data['TaskId']));

	$invoices=\B\IM\Logics::getInvoiceByTaskId($data['TaskId']);
	if(count($invoices) <1 )$invoices['Data']=[];
	$remaingAmount=[];
	$data['form-action-para']=[


    'TaskId'=>\MS\Core\Helper\Comman::en4url($data['TaskId']),
   // 'StepId'=>\MS\Core\Helper\Comman::en4url($data['StepId']),


    ];
    $data['form-action']=route('TMS.Task.Generate.Invoice.Post',$data['form-action-para']);

?>

<div class="panel panel-default">
	{!! Form::open(['url' => $data['form-action'],'method' => 'post','files' => true,'class'=>'ms-form ','role'=>'form']) !!}

	<div class="panel-heading bg-info"><i class="fa fa-sticky-note-o"  ></i> <strong>Genarate Inovoice For Task No. {{ $data['TaskId'] }}</strong> </div>
	<div class="panel-body">
				
		@include('B.L.Object.Error')
		<table class="table table-bordered">

			<tr> 
				
				<td colspan="2" >
					

					<?php
					 $dataForInput=[
'lable'=>'Master Invoice No.',

'name'=>'MasterInvoiceNo',
'value'=>'',
'data'=>[
	'required'=>true,
],

  ];

					?>
{{\Form::inputText($dataForInput,1)}}
	<?php
					 $dataForInput=[
'lable'=>'Notification No.',

'name'=>'NotificationNo',
'value'=>'',
'data'=>[
	'required'=>true,
],

  ];

					?>
{{\Form::inputText($dataForInput,2)}}





				</td>
			
			</tr>

				<tr class="ms-table-heading-tr">
			<th> Name of Document </th>		
			<th> Amount </th>

				</tr>


@foreach( $invoices['Data'] as $value )
@if($value['HasMasterInvoiceNo'] != 1 )
	
	<tr>

		<?php
 $dataForInput=[
'lable'=>' ',

'name'=>'SelectedFiles[]',
'value'=>'',	
	'dataArray'=>[  

	$value['UniqId'] =>[ 
		'name' =>explode('.',$value['NameofDocument'])[0],
  		'UniqId1'=>$value["UniqId"],
  		
  		]
	],

  

];




//dd($value);
		 ?>
		
		
		<td > {{\Form::inputCheck($dataForInput,1)}}
		<a class="btn btn-default" href="{{ route('TMS.Task.Get.File.Name',
		[
		'UniqId'=>\MS\Core\Helper\Comman::en4url($value['DocumentId']),
		'TaskId'=>\MS\Core\Helper\Comman::en4url($data['TaskId']),
		'StepId'=>\MS\Core\Helper\Comman::en4url($value['StepId']),
		'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($value['TypeOfDocument']),
		'FileName'=>$value['NameofDocument']])


		 }}" target="_BLANK"><i class="fa fa-eye"></i>  </td>
		<td>  {{  $value['Amount'] }} </td>
		</a>

	</tr>
	<?php $remaingAmount[]=$value['Amount']; ?>

	@endif

	
@endforeach

<?php 
$total=collect($remaingAmount)->sum();
?>
<tr class="success">
	<td>Total</td>
	<td>{{ $total }}</td>
</tr>
		</table>


	</div>
	<div class="panel-footer">
		
<div class="btn-group btn-group-justified">
		 
		 <div class="btn btn-default ms-text-black ms-mod-btn" ms-shortcut="back" ms-live-link=""><i class="fa fa-fast-backward"  ></i><br> Go Back</div>

		  <div class="btn btn-success ms-text-black btn-frm-submit" > Genarate Inovoice <i class="fa fa-sticky-note-o"  ></i></div>


		  </div>
	</div>
</div>

<script type="text/javascript">
<?php echo \MS\Core\Helper\OPV::validPrint(\B\TMS\R\AddInvoice::MS_rules()); ?>

	$('#error').slideUp();
</script>	