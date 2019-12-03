<div class="panel panel-info" >
                  
                        <div class="panel-heading"><i class="fa fa-user-secret" aria-hidden="true"></i> Agent Code:  {{  $data['agent']['AgentCode']}}
                     

                        </div>
                      
                        <div class="panel-body" >

                        <table class="table table-bordered">
                        <tr>
                          
                        <td class="col-lg-1" rowspan="5">
                       

     <img src="{{ asset('images/detective.svg') }}" style="max-height:100px;">
                            

                         
                        </td>
                         <th class="col-lg-2"> <span class="pull-right">Name : </span> </th> 
                      <td>  {{  $data['agent']['AgentName']}} </td>



                        </tr>
			
						            <tr>
                      
                      <th class="col-lg-2"><span class="pull-right">Contact No. :</span></th> 
                      <td>  {{  $data['agent']['AgentContactNo']}} </td>

                        </tr>   


                            <tr>
                      
                      <th class="col-lg-2"><span class="pull-right">Email : </span></th> 
                      <td>  {{  $data['agent']['AgentEmail'] or "No Email Found"}} </td>

                        </tr>        	

                        <tr>
                            <th class="col-lg-2"> <span class="pull-right">Last Known Location : </span> </th> 
                      <td>   <div id="map" class="col-lg-12  " style="height:300px;border:rgb(229, 227, 223);border-style:solid;"></div> </td>

                        </tr>

         <!--                <tr>
                            
                            <td colspan="2">
                            <h4 class="text-center">Last Known Location</h4 class="text-center">
                              <div id="map" class="col-lg-10 col-lg-offset-1 " style="height:300px;border:rgb(229, 227, 223);border-style:solid;"></div>


</div>

                            </td>

                        </tr> -->

                        </table>
                        <h4 class="col-lg-12">Agent Trip Details</h4>
                  

                            <?php 

$tableId=4;


    $build=new \MS\Core\Helper\Builder ("B\AAMS");
    //$build->title("View All Agency");
      \MS\Core\Helper\Comman::DB_flush();

      // $tripCode=
    
      // $table=\B\AAMS\Base::getTable(4,$tripCode);
      //   $connection=\B\AAMS\Base::getConnection(5);
    

   

    $model=new \B\AAMS\Model($tableId, session('user.userData.UniqId'));

    $model=$model->where('AgentCode',$data['agent']['AgentCode'])->paginate($tableId);
  //  dd($model);

            $diplayArray=[

        'TripCode'=>'Trip Code',

        'TaskCode'=>'Task Code',
        

        'created_at'=>'Time Stamp',



            ];

            $link=[

  

      // 'edit'=>[
      //  'method'=>'AMS.Agency.Edit.Id',
      //  'key'=>'UniqId',

      // ],


      // 'view'=>[
      //   'method'=>'AAMS.Agent.View.Id',
      //   'key'=>'AgentCode',

      // ],

      //  'LoginasAgency'=>[
      //  'method'=>'AMS.Agency.LoginAsAdmin.Id',
      //  'key'=>'UniqId',
      //  'icon'=>'fa fa-sign-in',
      //  'vName'=>'Login as Agency'

      // ],

    ];



            $build->listData($model)->listView($diplayArray)->addListAction($link); 

            //dd( $build->view(true,'list') );
            echo $build->view(true,'list');



?>

              
                    


                </div>

                <div class="panel-footer">
                  

                     <div class="btn-group btn-group-xs btn-group-justified" >
                              


                              <div class="btn btn-default ms-text-black ms-mod-btn" ms-live-link="{{ route('AAMS.index.Data') }}"><i class="fa fa-arrow-left"  ></i> Go Back to Agent List</div>
                            
                           

                            </div>




                </div>
                </div>


    
<script type="text/javascript">
  



var map_loaded=false;

var lat;
var lon;


if (navigator.geolocation) {
  console.log('Geolocation is supported!');

  var startPos;


  var geoSuccess = function(position) {
 
    // Do magic with location
    startPos = position;

    lat=startPos.coords.latitude;
    lon=startPos.coords.longitude;
    //console.log(startPos.coords.latitude);

    //console.log(startPos.coords.longitude);
 



if(!map_loaded){
  map_loaded=true;
    var myLatLng = {lat: {{ $data['agent']['AgentLastLAT'] }}, lng:  {{  $data['agent']['AgentLastLNG'] }}};
    var myLatLng2 = {lat: startPos.coords.latitude+1, lng: startPos.coords.longitude+1};

 var map;

       
        map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 10,
           mapTypeId : google.maps.MapTypeId.ROADMAP
        });

              var image = {
          url: 'https://nc.msllp.in/images/pin.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(32, 32),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(10, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 10)
        };

 var  marker = new google.maps.Marker({
                            draggable: false,
                            animation: google.maps.Animation.DROP,
                            title:"{{ $data['agent']['AgentCode'] }} ",
                            label:"{{ $data['agent']['AgentName'] }} ",
                            position: new google.maps.LatLng({{ $data['agent']['AgentLastLAT'] }}, {{  $data['agent']['AgentLastLNG'] }}),
                            map: map,
                            anchorPoint: new google.maps.Point(12, -25),
                            infoWindowContent:"{{ $data['agent']['updated_at'] }}",
                            //icon:image
                          });

marker.setMap(map);


          var clickEvent=  google.maps.event.addListener(marker, 'click', (function(marker, i) {

                             
                            return function() {
                                map.setZoom(15);
                               //map.setCenter({lat: locations.Lat, lng: locations.Lon});
                                var infowindow = new google.maps.InfoWindow({
                                content: marker.infoWindowContent,
                         
                                     });
                                infowindow.open(map, marker);

                             
                            }
                          
                          })(marker, 1));






    }






 }




  navigator.geolocation.getCurrentPosition(geoSuccess);





}
else {
  console.log('Geolocation is not supported for this Browser/OS.');
}




</script>


