
   <?php 

   $user=session('user.userData');

 $company=\B\MAS\Model::getCompany();
   // dd($user['name']);
   $userRole=0;
              if(session('user.SuperAdmin')){
                      $userRole=1;
                      }elseif (session('user.AgencyAdmin')) {
                      $userRole=2;
                      }else{
                      $userRole=0;
                      }



   ?>

<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog " role="document">


    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center"><i class="fa fa-user-circle-o fa-3x" style="padding-top: 10px;padding-bottom: 10px;" aria-hidden="true"></i> <br>Welcome  {{ $user['name']}}<br> <img class="ms-logo"  style="margin-left: 20px;margin-top: 10px;padding: 5px;
    padding-top: 10px;min-height: 60px;" src="{{asset('images/'.env('APP_V_LOGO_LG','billing.png'))}}" /><br></h4>
      </div>
  <div class=" text-center bg-info" style="padding:5px;">
        
         <small class=" ">Powered by <strong> {{env("APP_V_NAME",'MS System For Cloud ')}}</strong></small>
      </div>
      <div class="modal-body">
       
      
       <table class="table table-hover">
          
          <tr>
            <th colspan="2"> <h5><i class="fa fa-building-o fa-2x" aria-hidden="true"></i> {{$company['NameOfBussiness']}} Account Details</h5></th>

          </tr>

          <tr>
              
              <td><i class="fa fa-user-o" aria-hidden="true"></i> Name</td>
              <td>: <strong>{{ $user['name']}}</strong> </td>

          </tr>
           <tr>
              
              <td><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</td>
              <td>: <strong>{{ $user['email']}}</strong>  </td>

          </tr>

       </table>

      </div>
        <div class="model-footer text-center ">
        
         <small class="">A Genuine <img class="ms-logo" src="{{ asset('/images/logo_final.png') }}" style="margin-bottom: 5px;margin-top: 0px;    padding-left: 5px;
    padding-right: 5px;"> Product</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>

        
      </div>
    
                      
        
    </div>


 
  </div>
</div>