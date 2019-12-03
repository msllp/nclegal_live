

@extends('L.root_BackEnd')

@section('title')

{{env('APP_V_NAME',"MS-ERP 2.0.1") }} for {{B\MAS\Model::getCompanyName()}} , Solution Provided by Million Solutions LLP
@endsection

@section('content')


        <!-- Navigation -->
        @include('AAMS.V.Object.Nav')

  
            <div class="ms-content">
               

                    <div class="ms-live-tab">
                     
                        @yield('Page-content')
                	

                      

                    </div>

             
             
            
            </div>



@endsection


@section('breadcrumb')
<li > {{B\MAS\Model::getCompanyName()}}: </li>
<li >Home</li>
@yield('Page-breadcrumb')
<dl >{{ Carbon::now()->format('l\\, jS \\of F\\, Y')}} </dl>
@endsection

@section('js')

@endsection