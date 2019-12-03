@extends('B.L.AgentBasePlate')


@section('Page-content')
@include('AAMS.V.panel_dataForAgent',['data'=>$data])

@endsection

@section('Page-breadcrumb')
<li class="active"></li>
@endsection