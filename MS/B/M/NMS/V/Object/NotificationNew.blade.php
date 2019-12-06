@extends('B.L.ModPlate')


@section('title')

    <i class="{{$data['title']['icon']}}" aria-hidden="true"></i> <strong>{{$data['title']['str']}}</strong>

@endsection


@section('body')
    <table class="table table-bordered table-hover" id="notification-table">
        <thead>
        <tr class="ms-table-heading-tr">
            @foreach($data['tableColumn'] as $key=>$value)
                <th> {{$value }}</th>
            @endforeach
        </tr>
        </thead>
    </table>




    <script>

        var table = $('#notification-table').DataTable({
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
                $(row).attr('ms-live-link',  '{!! route("NMS.Notification.By.Id.Raw",[ "UserId"=>"" ]) !!}/'+data.UniqId);

                $(row).attr('class', "ms-mod-btn");

            }
            ,
            "columnDefs": [
                { "orderData": [ 0 ] , "targets": 0 ,"orderDataType": "dom-text", type: 'date'},
                { targets: [1],"orderable": false}
            ],
            "order": [[ 0, 'desc' ]]



        });

        // table.order( [[ 7, 'date' ]] );

    </script>

@endsection