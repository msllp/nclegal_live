@extends('L.root_BackEnd')



@section('title')

{{ env('APP_V_NAME', 'MS Cloud System')}}


for {{B\MAS\Model::getCompanyName()}} , Solution Provided by Million Solutions LLP
@endsection


@section('content')



    <div class="container">
        <div class="row">
     

            <div class="col-md-4 col-md-offset-4" style=" transform: translateY(20%);">
                <div class="login-panel panel panel-info" style="-webkit-box-shadow: 4px 4px 5px 0px rgba(0,0,0,0.5);
-moz-box-shadow: 4px 4px 5px 0px rgba(0,0,0,0.5);
box-shadow: 4px 4px 5px 0px rgba(0,0,0,0.5);">


                    <div class="panel-heading">
                        <span  class="row" >
                        
                        <p class="col-md-12 text-center">
                            
                            <img   style="max-height: 40px;" src="{{asset('images/logo_tr.png')}}">
                        </p>


            
                        
                        </span>
                    </div>


                    <div class="panel-body">
                
                             
             <h4 class=" text-center bg-danger" style="padding:5px;">Oops ! Please try again. </h4>
           <h1 class=" text-center bg-danger"  style="padding:5px;">ERROR Code: <code> 500 </code> </h1>
                                     
                                        <h6 class="panel-title  text-center"  style="padding:5px;">Click to Proceed for Login Control Panel</h6>                                    <div class="btn-group btn-group-justified" role="group" aria-label="...">

                                    <a href="{{url('/admin')}}">
                                <div  class="btn btn-sm btn-default  col-lg-6  ms-form-btn">
                                <i class="fa fa-sign-out fa-flip-horizontal " aria-hidden="true"></i>
                                   <img   style="max-height: 80px;" src="{{asset('images/admin.png')}}">

                                   </div></a>
<a href="{{url('/agency')}}">
                                      <div  class="btn btn-sm btn-default col-lg-6  ms-form-btn">

                                   <img   style="max-height: 80px;" src="{{asset('images/agency.png')}}">

                                    <i class="fa fa-sign-out " aria-hidden="true"></i></div>
                               </a>
                    
                                    </div>
                   </div>

<br>
                   <div class="panel-footer text-center" style="padding:0px;">


                   <table class="table " style="margin-bottom: 0px">

                     
                        <tr> <td colspan="2"><small> We greatly value your experience. </small></td> </tr >
                        <tr> <td><i class="fa fa-envelope-o" aria-hidden="true"> Mail us : <b>help@millionsllp.com</b></i></td> <td><i class="fa fa-phone-square " aria-hidden="true"> Call us : <b >+91 7990563470</b></i></td> </tr>



                        <tr>
                          
                          <td colspan="2">  <code> <small> Powered by <abbr title="MS Custom Cloud Application Series Tier I Solution Package">{{env("APP_V_NAME",'MS System For Cloud ')}}</abbr> & Managed by <abbr title="Million Solutions LLP">MSL </abbr> </code></td>
                        </tr>

                        <tr>
                          
                          <td colspan="2" > <i class="fa fa-copyright" aria-hidden="true"></i> {{date('Y')}}-{{date('Y')+1}},All rights reserved by<a href="http://www.millionsllp.com"> <strong>Million Solutions LLP</strong></a>.</td>
                        </tr>

                           
                          
                     
                      </table>
                         
                    </div>
</div>


</div>
</div>
</div>





@endsection
