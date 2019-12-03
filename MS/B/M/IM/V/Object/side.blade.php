	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">


        <div class="panel ms-side-head " >



            <h4 class="panel-title"  style="padding: 5px; padding-left: 10px;" >
                <span class="label label-default hidden-xs hidden-sm" ><i class="fa fa-keyboard-o" aria-hidden="true"></i>  Alt + 4</span>
                <span class="label label-default" ><i class="fa fa-inr" aria-hidden="true"></i> Invoices</span>
            </h4>

        </div>

  <div class="panel panel-default ms-side-title">
      



    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title  "  >




         <div class="btn-group ms-btn-full-width" role="group" aria-label="...">
          <span class="btn btn-default collapsed  ms-btn-full-width-main text-left" role="button" data-toggle="collapse" data-parent="#accordion" href="#IM_Side_1" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-user" aria-hidden="true"></i>  Agent's Bills </span>

           <span class="pull-right ms-mod-btn btn btn-default  ms-btn-full-width-side" ms-live-link="{{route('IM.index.Data')}}">
            
            <i class="fa fa-home" aria-hidden="true"></i>


          </span> 
        </div>
       
      </h4>

     
    </div>
    <div id="IM_Side_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body list-group">
       
		  <a href="#" class="list-group-item ms-mod-btn" ms-live-link="{{route('ADMS.Agent.Bill.View.All')}}"> <i class="fa fa-eye" aria-hidden="true"></i> View All</a>

  
    


      </div>
    </div>
  </div>







</div>