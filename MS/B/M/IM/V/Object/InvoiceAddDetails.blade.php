<?php 

//dd($data);

	$InvoiceData=[];
	$InvoiceSubData=[];
	
	$m1=new \B\IM\Model(\B\IM\F\Invoice::$lederTableId,$data['AgencyCode']);
	$m11=$m1->where('UniqId',$data['InvoiceCode']);
	$codeForTable=implode('_', [$data['AgencyCode'],$data['InvoiceCode']]);


	$AgencyData=\B\AMS\Logics::getAgency($data['AgencyCode']);
	//dd($AgencyData);

	if($m11->get()->count() > 0){

		$InvoiceData=$m11->get()->first()->toArray();
		//dd($InvoiceData);

		$m2=new \B\IM\Model(\B\IM\F\Invoice::$TableIdForSubLedger,$codeForTable);
	
		if($m2->get()->count()){

			$total=$m2->get()->sum('Amount');
			//dd($total);

			$InvoiceSubData=$m2->get()->toArray();

			if($InvoiceData['PartiallyPaid'] == '1')
			{
				
						$total=$total-$InvoiceData['TotalPaid'];
								
			}
				

		}
		

	}

	 $data['form-action-para']=[
		 	'AgencyCode'=>\MS\Core\Helper\Comman::en4url($data['AgencyCode']),
		 	'InvoiceCode'=>\MS\Core\Helper\Comman::en4url($data['InvoiceCode'])
		 	];

	   $data['form-action']=route('IM.Invoice.Add.Payment.By.Id.Post',$data['form-action-para']);



?>

<div class="panel panel-info">

	{!! Form::open(['url' => $data['form-action'],'method' => 'post','files' => true,'class'=>'ms-form ','role'=>'form']) !!}
	<div class="panel-heading hidden-print">  <strong>  <i class="fa fa-inr"  ></i> Add Payment for Inovoice: {{ $InvoiceData['MasterInvoiceId'] }}</strong> </div>
	<div class="panel-body">
@include('B.L.Object.Error')
	<table class="table table-bordered">
			

			<tr class="ms-table-heading-tr">
					<th> Invoice No.: {{ $InvoiceData['MasterInvoiceId'] }}  </th>
					<th><span class="pull-right">Date : {{ \Carbon::parse($InvoiceData['created_at'])->format('d / m / Y') }}</span> </th>


			</tr>








			<tr class="">
					<th> To  </th>
					<th > 
						<table class="ms-addressTable" border="0|0">
							
							<tr>
								
								<td>{{\B\AMS\Logics::getAgencyName($data['AgencyCode'])}}</td>
							</tr>

							@if($AgencyData['AddressLine1'] != null)
									<tr>
										<td>{{$AgencyData['AddressLine1']}}</td>
									</tr>
							@endif

							@if($AgencyData['AddressLine2'] != null)
									<tr>
										<td>{{$AgencyData['AddressLine2']}}</td>
									</tr>
							@endif


							@if(($AgencyData['AddressLine3'] != null) or ($AgencyData['AddressLine3'] != "") )
									<tr>
										<td>{{$AgencyData['AddressLine3']}}</td>
									</tr>
							@endif

							@if(($AgencyData['Landmark'] != null) or ($AgencyData['Landmark'] != "") )
									<tr>
										<td>{{$AgencyData['Landmark']}}.</td>
									</tr>
							@endif


							<tr>
										<td>
											@if(($AgencyData['City'] != null) or ($AgencyData['City'] != "") ){{$AgencyData['City']}}
											@endif

											@if(($AgencyData['State'] != null) or ($AgencyData['State'] != "") )
											, {{$AgencyData['State']}}
											@endif

											@if(($AgencyData['Pincode'] != null) or ($AgencyData['Pincode'] != "") )
											- {{$AgencyData['Pincode']}}
											@endif





										</td>
							</tr>


							
						</table>
					 	
					 </th>


			</tr>


					<tr class="info">
						<th><span >Date of Payment: {{ \Carbon::now()->format('d / m / Y') }}</span> </th>
					<th> 
							<?php
					 $dataForInput=[
'lable'=>'Add Payment',

'name'=>'Amount',
'value'=>$total,
'data'=>[
	'required'=>true,
],

  ];

					?>
{{\Form::inputNumber($dataForInput,2)}}





					  </th>
					


			</tr>


			<tr class="ms-table-heading-tr">
					<th> Bill ID </th>
					<th> <span class="pull-right"> Amount </span></th>


			</tr>

			@foreach($InvoiceSubData as $bill)
			

			<tr>
					
					<td>
						{{  explode('.',$bill['NameofDocument'])[0] }}

						<a class="btn btn-default pull-right hidden-print" href="{{ route('TMS.Task.Get.File.Name',
		[
		'UniqId'=>\MS\Core\Helper\Comman::en4url($bill['DocumentId']),
		'TaskId'=>\MS\Core\Helper\Comman::en4url($InvoiceData['TaskId']),
		'StepId'=>\MS\Core\Helper\Comman::en4url($bill['StepId']),
		'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($bill['TypeOfDocument']),
		'FileName'=>$bill['NameofDocument']])


		 }}" target="_BLANK"><i class="fa fa-eye"></i> </a> </td>
					</td>
					<td><span class="pull-right">₹ {{  \MS\Core\Helper\Comman::toINR($bill['Amount']) }} </span></td>

			</tr>

			@endforeach


			@if($InvoiceData['PartiallyPaid'] == '1')

			<tr class="info">
			
			<td>Total Paid</td>
			<td><span class="pull-right">- ₹ {{\MS\Core\Helper\Comman::toINR($InvoiceData['TotalPaid'])}}</span></td>

			
			@endif

			<tr class="success">
				<td>Total</td>
				<td><span class="pull-right">₹ {{\MS\Core\Helper\Comman::toINR($total)}}</span></td>
			</tr>



	</table>


	<span class="visible-print-block">
	

<table class="">

<tr>
	<th>Generated on</th>
	<td>: {{ \Carbon::parse($InvoiceData['created_at'])->format('l jS \\of F Y h:i:s a') }}</td>
</tr>

@if( $InvoiceData['created_at'] !=$InvoiceData['updated_at'] )

<tr>
	<th>Updated on</th>
	<td>: {{ \Carbon::parse($InvoiceData['updated_at'])->format('l jS \\of F Y h:i:s a') }}</td>
</tr>
@endif
<tr>
	<th>Printed on</th>
	<td>: {{ \Carbon::now()->format('l jS \\of F Y h:i:s a') }}</td>
</tr>


</table>

</span>


	</div>



	<div class="panel-footer hidden-print">
		
<div class="btn-group btn-group-justified">
		 
		 <div class="btn btn-default ms-text-black ms-mod-btn" ms-shortcut="back" ms-live-link=""><i class="fa fa-fast-backward"  ></i><br> Go Back</div>


		 <div class="btn btn-success ms-text-black btn-frm-submit"><i class="fa fa-floppy-o"  ></i><br> Save</div>

		 



 


		  </div>
	</div>


	{!! Form::close()  !!}

</div>
</div>

<script type="text/javascript">

	$('#error').slideUp();
</script>	