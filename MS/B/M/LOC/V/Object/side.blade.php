	<div class="panel-group hidden-print" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel ms-side-head">


            <h4 class="panel-title"  style="padding: 5px; padding-left: 10px;" >
               <span class="label label-default hidden-xs hidden-sm" ><i class="fa fa-keyboard-o" aria-hidden="true"></i>  Alt + 5</span>
               <span class="label label-default" ><i class="fa fa-compass" aria-hidden="true"></i> Location</span>
              
          

            </h4>

        </div>


  <div class="panel panel-default ms-side-title">
      



    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title  "  >




         <div class="btn-group ms-btn-full-width" role="group" aria-label="...">
          <span class="btn btn-default collapsed  ms-btn-full-width-main text-left" role="button" data-toggle="collapse" data-parent="#accordion" href="#LOC_Side_1" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-globe" aria-hidden="true"></i> Onfield Agents</span>

           <span class="pull-right ms-mod-btn btn btn-default  ms-btn-full-width-side" ms-live-link="{{route('LOC.index.Data')}}" ms-breadcrumb="Modules/Location Tracing System">
            
            <i class="fa fa-home" aria-hidden="true"></i>


          </span> 
        </div>
       
      </h4>

     
    </div>
    <div id="LOC_Side_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body list-group">
        
		  <a class="list-group-item ms-mod-btn" ms-live-link="{{route('LOC.Agent.View')}}" ms-breadcrumb="Modules/Location Tracing System/View All Agents"> <i class="fa fa-users" aria-hidden="true"></i> View All Agents</a>
       <a class="list-group-item ms-mod-btn" ms-live-link="{{route('LOC.Location.Search.Trip')}}" ms-breadcrumb="Modules/Location Tracing System/Search Trips"> <i class="fa fa-search" aria-hidden="true"></i> Search Trips</a>

  
    


      </div>
    </div>
  </div>







</div>