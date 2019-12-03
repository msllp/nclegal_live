@extends('B.L.ModPlate')


@section('title')

<i class="{{$data['title']['icon']}}" aria-hidden="true"></i> <strong>{{$data['title']['str']}}</strong>

@endsection


@section('body')
	
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

@endsection