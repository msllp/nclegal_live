<div class="panel panel-default">
	
<div class="panel-heading"><h5><strong> <i class="glyphicon glyphicon-home"></i> Details of Trip : {{ $UniqId }} </strong></h5></div>
<div class="panel-body">


<div class="col-lg-12">


  <?php 
  $UniqIdEx=explode("_", $UniqId);
  $taskCode=$UniqIdEx[0];
  $agencyCode=$UniqIdEx[1];
  $agentCode=implode('_', [ $UniqIdEx[1],$UniqIdEx[2]  ]);
  //dd($UniqId);
  //dd($agencyCode);
  $agentName=\B\AAMS\Logics::getAgentCode($agentCode);
  $agencyName=\B\AMS\Logics::getAgencyName($agencyCode);
  //dd($m);
  ?>




  <table class="table table-bordered table-hover ">
      <tr class="">
        <th class="col-lg-1 visible-md visible-lg">Agent Code:</th>
        <td class="col-lg-2 visible-md visible-lg">  {{$agentCode}}</td>
        <td rowspan="5"  colspan="2" class="col-xs-12 col-sm-12 col-md-9 col-lg-9 ">
          
          <div   id="map" style="height:55vh;min-height:150px;min-width:200px;border:rgb(229, 227, 223);border-style:solid;" ></div>
        </td>
      </tr>

      <tr class="visible-md visible-lg">
        <th>Agent Name :</th>
        <td>  {{$agentName}}</td>
      </tr>

        <tr class="visible-md visible-lg">
        <th>Agency :</th>
        <td>  {{$agencyName}}</td>
      </tr>

   <tr class="visible-md visible-lg">
        <th>Task Code :</th>
        <td>  {{$taskCode}}</td>
      </tr>




     <tr class="visible-xs visible-sm">
        <th >Agent Code:</th>
        <td >  {{$agentCode}}</td>
        
      </tr>

      <tr class="visible-xs visible-sm">
        <th>Agent Name :</th>
        <td>  {{$agentName}}</td>
      </tr>

        <tr class="visible-xs visible-sm">
        <th>Agency :</th>
        <td>  {{$agencyName}}</td>
      </tr>

   <tr class="visible-xs visible-sm">
        <th>Task Code :</th>
        <td>  {{$taskCode}}</td>
      </tr>
  

  </table>



</div>

</div>


<div class="panel-footer hidden-print">
  
    <div class="btn btn-info ms-text-black ms-mod-btn " ms-live-link="{{ route('LOC.Location.Search.Trip') }}" ms-breadcrumb="Modules/Location Tracing System/Search Trips"><i class="fa fa-fast-backward"  ></i> Go Back to Search Trip</div>

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
    var myLatLng = {lat: startPos.coords.latitude, lng: startPos.coords.longitude};
    var myLatLng2 = {lat: startPos.coords.latitude+1, lng: startPos.coords.longitude+1};

 var map;

       
        map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 10,
           mapTypeId : google.maps.MapTypeId.ROADMAP
        });

               var image = {
          url: 'http://cdn.msllp.in/detective.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(40, 32),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(12, 32),

          labelOrigin: new google.maps.Point(16, 40)
        };

               var marker, i,poly,last;
                poly=new Array();
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '{{ route("LOC.Location.TripBy.UniqId.Json",["UniqId"=>\MS\Core\Helper\Comman::en4url($UniqId)])  }}', true);
                xhr.responseType = 'json';
                xhr.onload = function() {
                  var status = xhr.status;
                  if (status === 200) {


                   
                    for (i in xhr.response) {


                      var locations=xhr.response[i];
                      console.log(locations);
                     // console.log(locations.created_at);
                         var  marker = new google.maps.Marker({
                            draggable: false,
                            animation: google.maps.Animation.DROP,
                            title:locations.title,
                            label:locations.agentCode,
                            position: new google.maps.LatLng(locations.lat, locations.lng),
                            map: map,
                            anchorPoint: new google.maps.Point(12, -25),
                            infoWindowContent:locations.details,
                         //   icon:image
                          });

                        poly[i]=new google.maps.LatLng(locations.lat, locations.lng);
                        last= poly[i];
                        //  var infowindow = new google.maps.InfoWindow({
                        //   content: locations.UserCode+"<br>"+locations.created_at,
                         
                        // });
                        //  infowindow.setContent( locations.UserCode+"<br>"+locations.created_at);
                        //  infowindow.open(map, marker);
                        var clickEvent=  google.maps.event.addListener(marker, 'click', (function(marker, i) {

                             
                            return function() {
                                map.setZoom(15);
                               //map.setCenter({lat: locations.Lat, lng: locations.Lon});
                                var infowindow = new google.maps.InfoWindow({
                                content: marker.infoWindowContent,
                         
                                     });
                                infowindow.open(map, marker);

                             
                            }
                          
                          })(marker, i));


                     //  console.log(xhr.response[i].Lat);


                    
                     }

                   //   console.log(xhr.response);


                     var lineSymbol = {
                        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                        scale: 3,
                        strokeColor: '#212121'
                      };
                      var flightPath = new google.maps.Polyline({
                      path: poly,
                      geodesic: true,
                      strokeColor: '#FF0000',
                      strokeOpacity: 1.0,
                      strokeWeight: 2,
                      icons: [{
                        icon: lineSymbol,
                        offset: '100%'
                      }],
                    });

                      animateCircle(flightPath);

                     flightPath.setMap(map);
                    //callback(null, JSON.parse(xhr.response));

                      map.setCenter(last);


                     function animateCircle(line) {
                          var count = 0;
                          window.setInterval(function() {
                            count = (count + 1) % 200;

                            var icons = line.get('icons');
                            icons[0].offset = (count / 2) + '%';
                            line.set('icons', icons);
                        }, 200);
                      }
   

                  } else {
                    //callback(status, JSON.parse(xhr.response));
                  }
                };
                xhr.send();
         




      








    }






 }




  navigator.geolocation.getCurrentPosition(geoSuccess);





}
else {
  console.log('Geolocation is not supported for this Browser/OS.');
}


</script>


