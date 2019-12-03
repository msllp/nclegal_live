@extends('B.L.BasePlate')


@section('Page-content')
@include('Panel.V.Panel_data',['data'=>[]])
@endsection

@section('Page-breadcrumb')
<li class="active"></li>
@endsection