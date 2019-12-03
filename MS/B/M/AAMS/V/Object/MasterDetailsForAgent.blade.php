 
  
<?php
  
  $m=new \B\AAMS\Model(3,session('agent.AgencyCode'));

  $cuurenTask= $m->where('AgentCode',session('agent.AgentCode'))->get()->pluck('AgentCurrentTask')->first();

  //dd( $m->where('AgentCode',session('agent.AgentCode'))->get()->pluck('AgentCurrentTask')->first() ) ;


  \MS\Core\Helper\Comman::DB_flush();

  $m=new \B\TMS\Model(0);
  $cuurenTask=$m->where('UniqId',$cuurenTask)->get()->first() ;
  //dd($cuurenTask!= null);

?>

 {!! Form::open(['route' => 'AAMS.Agent.TaskPost','method' => 'post','files' => true,'class'=>'ms-form']) !!}
 <div class="panel panel-info">
    
 <div class="panel-heading" > Select Task to Start Trip </div>
 <div class="panel-body">
<h4>Current task Details</h4>
@if($cuurenTask!= null)


<?php 
//dd($m->where('UniqId',$cuurenTask)->get()->first());
$cuurenTask=$cuurenTask->toArray();
//dd($cuurenTask);

 ?>
<table class="table table-bordered">


<tr>
  <th class="col-xs-3 col-sm-3">Task ID</th>
  <td>: {{ $cuurenTask['UniqId'] }}</td>
</tr>
  
<tr>
  <th>Name of Piracy Network</th>
  <td>: {{ $cuurenTask['NameOperator'] }}</td>
</tr>

<tr>
  <th>Name of Owner</th>
  <td>: {{ $cuurenTask['NameOwner'] }}</td>
</tr>


 <tr>
                    <?php

              // dd($data);
                  
                  $address='';

                  if($cuurenTask['NameOperatorAddress1'] != null or  $cuurenTask['NameOperatorAddress1'] !=' ' )$address.=$cuurenTask['NameOperatorAddress1'];
                  if($cuurenTask['NameOperatorAddress2'] != null or  $cuurenTask['NameOperatorAddress2'] !=' ' )$address.=",".$cuurenTask['NameOperatorAddress2'];
                  if($cuurenTask['NameOperatorAddress3'] != null or  $cuurenTask['NameOperatorAddress3'] !=' ' )$address.=",".$cuurenTask['NameOperatorAddress3'];

                  $address.=",".$cuurenTask['NameOperatorCity'].",".$cuurenTask['NameOperatorDistrict'].",".$cuurenTask['NameOperatorState']."-".$cuurenTask['NameOperatorPincode']

                 ?>


                <th>Location of Control Room</th>
   
                <td>: {{$address}}</td>

</tr>



              <tr>
                
             
                          <?php

  
                  $Paddress='';

                  if($cuurenTask['NameAreaPiracyCity'] != null or  $cuurenTask['NameAreaPiracyCity'] !=' ' )$Paddress.=$cuurenTask['NameAreaPiracyCity'];
                  if($cuurenTask['NameAreaPiracyDistrict'] != null or  $cuurenTask['NameAreaPiracyDistrict'] !=' ' )$Paddress.=",".$cuurenTask['NameAreaPiracyDistrict'];
                  if($cuurenTask['NameAreaPiracyState'] != null or  $cuurenTask['NameAreaPiracyState'] !=' ' )$Paddress.=",".$cuurenTask['NameAreaPiracyState'];
                  if($cuurenTask['NameAreaPiracyPincode'] != null or  $cuurenTask['NameAreaPiracyPincode'] !=' ' )$Paddress.="-".$cuurenTask['NameAreaPiracyPincode'];

                 // $Paddress.=$data['task']['NameOperatorCity'].",".$data['task']['NameOperatorDistrict'].",".$data['task']['NameOperatorState']."-".$data['task']['NameOperatorPincode']

                 ?>

                <th>Area of Piracy</th>
                <td>:  {{$Paddress}} </td>
              
              </tr>  


</table>
@else
No Current Task Found Please Select Task

@endif


<h4></h4>

 <div class="form-group">

                                    <div class="input-group">
                                      <div class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i>  <small> Task </small></div>
                                      

                                      <?php 


                                      \MS\Core\Helper\Comman::DB_flush();
                                      $uniqId= session("agent.AgencyCode");
                                      $tableId=0; 
                                      $model=new \B\TMS\Model($tableId);

                                      $model=$model->where('HireAgencyCode',$uniqId);

                                      $dataRaw=$model->get()->toArray();
                                      $data=[];
                                   


                                      foreach ($dataRaw as $key => $value) {
                                        $data[ $value['UniqId'] ]=$value['NameOwner'].",".$value['NameOperator'].",[".$value['UniqId']."]";
                                      }

                                      //  dd($data);

                                   //    \MS\Core\Helper\Comman::DB_flush();
                                   //    $m=new \B\AMS\Model();

                                      


                                   //    $data=$m->MS_all()->pluck('Name','UniqId')->toArray();

                                   // dd( $data  );

                                        echo Form::select("TaskCode" ,$data,null,['class'=>"form-control"]) ;

                                    
                                      ?>

                                   

                         <p class="help-block">Name of Owner/Partner,Name of Piracy Network,[TaskID] </p>

                                    </div>

                                </div>


  </div>

  <div class="panel-footer">
    

   <div  class="btn   btn-lg btn-success btn-block ms-form-btn btn-frm-submit"><i class="fa fa-plane " aria-hidden="true"></i><br> Start Trip </div>


   <div  class="btn btn-lg btn-info btn-block ms-live-btn" ms-live-link="{{  route('AAMS.Agent.Upload.Form',['agentCode'=>\MS\Core\Helper\Comman::en4url(session('agent.AgentCode'))]) }}"><i class="fa fa-inr " aria-hidden="true"></i><br> Add Bill </div>

  </div>

 </div>

 {!! Form::close() !!}


<script type="text/javascript"> 

  

      var agencyCode="{{session('agent.AgencyCode')}}";
      var agentCode="{{session('agent.AgentCode')}}";
      var ApiToken="{{session('agent.ApiToken' )}}";

        Android.showToast("Agent:"+agentCode+" successfully logged in.");

          Android.setUser(agencyCode, agentCode,ApiToken);

var lat;
var lon;
var link="{{ route('AAMS.Agent.LoctionPost') }}";
if (navigator.geolocation) {
  console.log('Geolocation is supported!');

  var startPos;

  
  var geoSuccess = function(position) {
 
    // Do magic with location
    startPos = position;

    lat=startPos.coords.latitude;
    lon=startPos.coords.longitude;
    //console.log(startPos.coords.latitude);

     // console.log("lat:"+lat);
     //   console.log("lon:"+lon);




       var params = ({
    AgencyCode: agencyCode,
    AgentCode: agentCode,
    ApiToken :ApiToken,
    lat : lat,
    lon : lon,
    Web: true

    });
       var queryString = Object.keys(params).map(key => key + '=' + params[key]).join('&');



      var xmlHttp = new XMLHttpRequest();
   
      xmlHttp.open( "GET", link+"?"+queryString, true ); // false for synchronous request
      xmlHttp.send();
      //  return xmlHttp.responseText;
       console.log(xmlHttp);


    };

   navigator.geolocation.getCurrentPosition(geoSuccess);  
  }


 //  console.log(lat);

     
</script>


