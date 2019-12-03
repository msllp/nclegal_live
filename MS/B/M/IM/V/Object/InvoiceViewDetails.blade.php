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
			$InvoiceSubData=$m2->get()->toArray();
				

		}


			if($InvoiceData['PartiallyPaid'] == '1')
			{
				
						$total=$total-$InvoiceData['TotalPaid'];
								
			}
		

	}


?>

<div class="panel panel-info">


	<div class="panel-heading hidden-print">  <strong>  <i class="fa fa-sticky-note-o"  ></i> View Inovoice: {{ $InvoiceData['MasterInvoiceId'] }}</strong> </div>
	<div class="panel-body">

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

			@if(($InvoiceData['TotalPaid'] == $InvoiceData['Total']))
			

			<tr class="info">
				<td>Date Of Payment</td>
				<td><span class="pull-right">
					@if($InvoiceData['DateOfPaymentToAgency'] > 0)
            {{ \Carbon::parse($InvoiceData['DateOfPaymentToAgency'])->format('d/m/Y') }}
            @else
            Opps,No Date Of Payment Found !
            @endif
				</span></td>
			</tr>
			

			@endif



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



		 @if(($InvoiceData['TotalPaid'] != $InvoiceData['Total']) && ( $InvoiceData['TotalPaid'] <= $InvoiceData['Total'] )   )
		 <div class="btn btn-success ms-text-black ms-mod-btn" ms-live-link="{{ route('IM.Invoice.Add.Payment.By.Id',
		 
		 [
		 	'AgencyCode'=>\MS\Core\Helper\Comman::en4url($data['AgencyCode']),
		 	'InvoiceCode'=>\MS\Core\Helper\Comman::en4url($data['InvoiceCode'])
		 	]

		 )  }}"><i class="fa fa-inr"  ></i><br> Add Payment</div>
		 @endif

		  <div onclick="window.print()" class="btn btn-info ms-text-black" ms-shortcut="back" ms-live-link=""><i class="fa fa-print"  ></i><br> Print</div>



 


		  </div>
	</div>
</div>