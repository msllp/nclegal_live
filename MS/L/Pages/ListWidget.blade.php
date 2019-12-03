
	
	  <table class="table table-bordered table-hover" id="users-table">
        <thead>
            <tr class="ms-table-heading-tr">
            	<th>Created On </th>
                <th>Task Id</th>
                <th>Name of Assined Agency</th>
                <th>Name of Operator</th>
               
               <!--  <th>NameOperatorCity</th>
                <th>NameOperatorDistrict</th> -->
                <th>Mode of Piracy</th>
                
                 <th>Cur. Status</th>

            </tr>
        </thead>
    </table>	




	<script>

    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{!! route('test.ajax') !!}',
        columns: [
        
             { data: 'created_at_string', name: 'created_at_string'},
            { data: 'UniqId', name: 'UniqId'},
            { data: 'HireAgencyCode', name: 'HireAgencyCode'},
            { data: 'NameOperator', name: 'NameOperator'},
            
            // { data: 'NameOperatorCity', name: 'NameOperatorCity'},
            // { data: 'NameOperatorDistrict', name: 'NameOperatorDistrict'},
            { data: 'ModePiracy', name: 'ModePiracy'},
           
            { data: 'CurrentStatus', name: 'CurrentStatus'}

          
           
        ],

        'createdRow': function( row, data, dataIndex ) {
    			  $(row).attr('ms-live-link',  '{!! route("TMS.Task.View.Id",[ "UniqId"=>"_" ]) !!}'+data.UniqId);
    			  $(row).attr('class', "ms-mod-btn");
		  }
		  ,
		  "columnDefs": [
                { "orderData": [ 0 ] , "targets": 0 ,"orderDataType": "dom-text", type: 'date'},
                { targets: [2,3,4],"orderable": false}
            ],
            "order": [[ 0, 'desc' ]]
            


    });

   // table.order( [[ 7, 'date' ]] );

</script>

