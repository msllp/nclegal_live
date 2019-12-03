

@extends('L.root_BackEnd')

@section('title')

{{env('APP_V_NAME',"MS-ERP 2.0.1") }} for {{B\MAS\Model::getCompanyName()}} , Solution Provided by Million Solutions LLP
@endsection

@section('content')


        <!-- Navigation -->
        @include('B.L.Object.Nav')

  
            <div class="ms-content container-fluid">
                <div class="row">

                    <div class="ms-live-tab">
                        <div class="ms-mod-tab">
                        <div class="panel-heading">@yield('Page-title') </div>
                        @include('B.L.Object.Error')
                        @yield('Page-content')
                        </div>
                       


                    </div>

                </div>
             
            
            </div>

 @include('B.L.Object.User')
 @include('B.L.Object.Shortcut')
 






@endsection


@section('breadcrumb')
<li class=" ms-live-link" ms-live-link='{{action("\B\Panel\Controller@index") }}'> {{B\MAS\Model::getCompanyName()}}: </li>
<li class=" ms-live-link" ms-live-link='{{action("\B\Panel\Controller@index") }}'>Home</li>
@yield('Page-breadcrumb')
<dl class=" ms-live-link pull-right" ms-live-link='{{action("\B\Panel\Controller@index") }}'>{{ Carbon::now()->format('l\\, jS \\of F\\, Y')}} <span id="clock">{{ Carbon::now()->format('h:i:s A')}}</span></dl>
@endsection

@section('js')

@endsection