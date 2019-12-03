
<?php
//dd($data);



	$rData =[];
	if (!array_key_exists('Status', $rData)) $rData['Status'] = 0;



	$data=[

		'title'=>[
					'str'=>"Invoices",
					'icon'=>"fa fa-inr"
				],
		'tableColumn'=>[
			'created_at_string'=>"Created On",
			'MasterInvoiceId'=>"Invoice No.",
			'TaskId'=>'Task Id',
			'Total'=>'Total ',
			
			// 'HireAgencyCode'=>"Assined Agency",
			// 'NameOperator'=>'Name of Operator',
			// 'ModePiracy'=>'Mode of Piracy',
			// 'CurrentStatus'=>'Current Status',
		],

		'ajax'=>route("IM.Invoice.Get.All.Ajax",['AgencyCode'=>\MS\Core\Helper\Comman::en4url($data['AgencyCode'])]),
		'AgencyCode'=>$data['AgencyCode'],
	];

//	return view("TMS.V.Object.TaskOpenView")->with('data',$data);
    

$m1=new \B\IM\Model(\B\IM\F\Invoice::$lederTableId,$data['AgencyCode']);

$hasInvoices=0;
$invoiceCount=0;
$InvoiceData=[];
//dd($m1->checkCurrentTable());
if($m1->checkCurrentTable()){
$hasInvoices=1;
$m1=new \B\IM\Model(\B\IM\F\Invoice::$lederTableId,$data['AgencyCode']);

	$invoiceCount=$m1->get()->count();
		//dd($invoiceCount);

		


}

//dd($InvoiceData);


 ?> 



	@if($hasInvoices && ($invoiceCount > 0))
	<table  class="table table-bordered table-hover">
		
		<thead>
        	 <tr class="info">
                
                <th > Invoice List</th>
           
            </tr>
        </thead>
	</table>
	  <table class="table table-bordered table-hover" id="users-table">
        <thead>
        	
            <tr class="ms-table-heading-tr">
                @foreach($data['tableColumn'] as $key=>$value)
                <th> {{$value }}</th>
                @endforeach
            </tr>
        </thead>
    </table>	




	<script>

    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{!! $data["ajax"] !!}',
        columns: [
        
            @foreach($data['tableColumn'] as $key=>$value )
                @if($loop->last)
                { data: '{{$key}}', name: '{{$key}}'}
                @else
                { data: '{{$key}}', name: '{{$key}}'},
                @endif
            @endforeach
             
        
         ],

        'createdRow': function( row, data, dataIndex ) {
    			  $(row).attr('ms-live-link',  
    			  	'{!! route("IM.InvoiceDetails.By.Id.DataLink",[ "data"=>"_".$data["AgencyCode"]."_"] ) !!}'+  data.UniqId );
    			  $(row).attr('class', "ms-mod-btn");
		  }


    });

   // table.order( [[ 7, 'date' ]] );

</script>

@else
	  <table class="table table-bordered table-hover">
        <thead>
            <tr class="ms-table-heading-tr">
              
                <th>Oops, No Invoice Generated Yet !
                      </th>
             
            </tr>
        </thead>
    </table>	


@endif