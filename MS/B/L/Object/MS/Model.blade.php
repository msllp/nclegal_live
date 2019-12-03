

<div class="modal fade" id="msModel" tabindex="-1" role="dialog" >
  <div class="modal-dialog  modal-lg" role="document">


    <div class="modal-content  ms-model-box">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


        <h4 class="modal-title text-center">
          {{ $data['header'] }}
        </h4>
      


      </div>
  <div class=" text-center bg-info" style="padding:5px;">
        
<small class=" ">Powered by <strong> {{env("APP_V_NAME",'MS System For Cloud ')}}</strong></small>
      </div>
      <div class="modal-body">
       
        <?php echo $data['body']; ?>
        


      </div>
        <div class="model-footer text-center ">
          
          {{ $data['footer'] }}


         <small class="">A Genuine <img class="ms-logo" src="{{ asset('/images/logo_final.png') }}" style="margin-bottom: 5px;margin-top: 0px;    padding-left: 5px;
    padding-right: 5px;"> Product</small>
      </div>
      
      <div class="modal-footer">
    
      </div>
    
                      
        
    </div>


 
  </div>
</div>