	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel ms-side-head " ms-live-link="{{ action("\B\MAS\Controller@indexData") }}" >



            <h4 class="panel-title"  style="padding: 5px; padding-left: 10px;" >
                <span class="label label-default hidden-xs hidden-sm" ><i class="fa fa-keyboard-o" aria-hidden="true"></i>  Alt + 1</span>
                <span class="label label-default" ><i class="fa fa-cogs" aria-hidden="true"></i> Master </span>
            </h4>

        </div>



        <div class="panel panel-default ms-side-title">
      



    <div class="panel-heading" role="tab" id="MAS_side_1">
      <h4 class="panel-title  "  >




         <div class="btn-group ms-btn-full-width" role="group" aria-label="...">
          <span class="btn btn-default collapsed ms-btn-full-width-main text-left " role="button" data-toggle="collapse" data-parent="#accordion" href="#MAS_side_1_1" aria-expanded="false" aria-controls="MAS_side_1"><i class="fa fa-archive" aria-hidden="true"></i> Company Master </span>

           <span class="pull-right ms-mod-btn btn btn-default ms-btn-full-width-side" ms-live-link="{{ action("\B\MAS\Controller@indexData") }}">
            
            <i class="fa fa-home" aria-hidden="true"></i>


          </span> 
        </div>
       
      </h4>

     
    </div>
    <div id="MAS_side_1_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="MAS_side_1">
      <div class="panel-body list-group">
       
		  <a href="#" class="list-group-item ms-mod-btn" ms-live-link="{{ action("\B\MAS\Controller@editCompany") }}" ms-breadcrumb="Modules/ Master / Manage Company"><i class="fa fa-university" aria-hidden="true"></i> Manage Company Details</a>
		  <a href="#" class="list-group-item ms-mod-btn" ms-live-link="{{ action("\B\MAS\Controller@viewTax") }}"  ms-breadcrumb="Modules/ Master / Tax Details"><i class="fa fa-percent" aria-hidden="true"></i> Manage Tax Details</a>
		  <a href="#" class="list-group-item ms-mod-btn" ms-live-link="{{ action("\B\MAS\Controller@editHSNSAC") }}"  ms-breadcrumb="Modules/ Master / Manage HSN or SAC"><i class="fa fa-code" aria-hidden="true"></i> Manage HSN/SAC</a>
		  <a href="#" class="list-group-item ms-mod-btn" ms-live-link="{{ action("\B\MAS\Controller@viewTNC") }}"  ms-breadcrumb="Modules/ Master / Manage Terms & Conditions"><i class="fa fa-handshake-o" aria-hidden="true"></i> Manage Terms & Conditions</a>


      <a href="#" class="list-group-item ms-mod-btn" ms-live-link="{{ action("\B\Users\Controller@view_all_users") }}"  ms-breadcrumb="Modules/ Master / Manage Users"><i class="fa fa-users" aria-hidden="true"></i> Manage Users</a>



      
		
      </div>
    </div>
  </div>


    <div class="panel panel-default ms-side-title">
      



    <div class="panel-heading" role="tab" id="MAS_side_2">
      <h4 class="panel-title  "  >




         <div class="btn-group ms-btn-full-width" role="group" aria-label="...">
          <span class="btn btn-default collapsed ms-btn-full-width-main text-left " role="button" data-toggle="collapse" data-parent="#accordion" href="#MAS_side_2_1" aria-expanded="false" aria-controls="#MAS_side_2"><i class="fa fa-archive" aria-hidden="true"></i> Agent Master </span>

           <span class="pull-right ms-mod-btn btn btn-default ms-btn-full-width-side" ms-live-link="{{ action("\B\MAS\Controller@indexData") }}">
            
            <i class="fa fa-home" aria-hidden="true"></i>


          </span> 
        </div>
       
      </h4>

     
    </div>
    <div id="MAS_side_2_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="MAS_side_2">
      <div class="panel-body list-group">
       
      <a href="#" class="list-group-item ms-mod-btn" ms-live-link="{{ route('ADMS.TypeOfDocument.ViewAll') }}" ms-breadcrumb="Modules/ Master / Agents / Manage Type Of Documents"><i class="fa fa-university" aria-hidden="true"></i> Manage Types of Documents</a>
     

      
    
      </div>
    </div>
  </div>

</div>