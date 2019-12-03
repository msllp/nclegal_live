<div class="panel panel-info" >



<div class="panel-heading"><h5><strong> <i class="fa fa-search"></i> Search Trip </strong></h5></div>
<div class="panel-body">

<?php 
$dataForOption=[
'lable'=>'Search By',

'name'=>'SearchBy',
'data'=>[ 
              '0'=>'Agency',
              '1'=>'Task ID',
              // '2'=>'States',
              // '3'=>"Month",
        


],
'value'=>'0',
'ClassData'=>['form-class-div'=>'col-lg-4']


];




        ?>
{{\Form::inputOption($dataForOption)}}


<?php 

                    \MS\Core\Helper\Comman::DB_flush();
                    $m2=new \B\AMS\Model();

                    $allAganecyData=$m2->MS_all()->pluck('Name','UniqId')->toArray();
                   

                    $Agenctdata=[];

                    foreach ($allAganecyData as $key => $value) {

                      \MS\Core\Helper\Comman::DB_flush();
                      $m3=new \B\AAMS\Model(3,$key);

                      if($m3->MS_all()->count() >0){

                        $con=\B\AAMS\Base::getConnection(4);
                        $table=\B\AAMS\Base::getTable(4,$key);
                      

                        if( \B\AAMS\Model::checkTableinDB($con,$table)){

                        \MS\Core\Helper\Comman::DB_flush();
                        $m4=new \B\AAMS\Model(4,$key);

                        if($m4->MS_all()->count() > 0 ){

                          if(!array_key_exists($key, $Agenctdata))$Agenctdata[$key]=$value;

                        }

                      //  var_dump();



                        }
                     


                      }

                      //var_dump();
                      # code...
                    }


                   // dd($Agenctdata);
                   //  $mData=$m2->MS_all()->groupBy('HireAgencyCode');

                   //  $mDataKey=array_keys($mData->toArray());
                   // // dd( );



                   //  foreach ($mDataKey as $key => $value) {
                        
                   //      $con=\B\AAMS\Base::getConnection(4);
                   //      $table=\B\AAMS\Base::getTable(4,$value);
                   //      //$taskHaveTrips=[];
                   //      if(\B\AAMS\Model::checkTableinDB($con,$table)){

                   //          //$m3=new \B\AAMS\Model(4,)
                   //          //dd($value); 

                   //      }
                   //  }

                   //  \MS\Core\Helper\Comman::DB_flush();
                   //  $m1=new \B\TMS\Model(0);


                   //  $data=$m1->get()->groupBy('CurrentStatus')->toArray();
                   //  //dd();

                   //  $types=array_keys($data);
                   //  //dd($types);
                    
                   //  $m= [];

                   //  foreach ($types as $value) {
                        
                   //      $m[$mData[$value]]=$mData[$value];


                   //  }




  ?>
<div class="form-group col-lg-4">

<label for="QueryText">Select</label> 

<select class="form-control ms-live-data-load" ms-live-link="{{ route('LOC.Location.Search.Trip.Data') }}" id="QueryText" name="QueryText">
    
@foreach($Agenctdata as  $code=>$text )


<option value="{{ $code }}">{{ $text }}</option>


@endforeach

</select>

</div>






<div class="btn btn-info col-lg-4 ms-text-black ms-search-btn hidden-print" style="margin-top:10px;"><i class="fa fa-search" aria-hidden="true"></i> <br>Search</div>
	<br>

<div class="panel panel-default col-lg-12" style="padding-left:0px;padding-right: 0px;">
	
<div class="panel-heading"> Search Result </div>
<div class="panel-body  ms-search-result" ms-live-link=" {{ route('LOC.Location.Search.Trip') }} "></div>

</div>



</div>

<script type="text/javascript">
	

	$( "[name=SearchBy]" ).change(function() {
  	//alert( $("option:selected").val()  );

	TypeOfSearch=$("#SearchBy").val();

 	link=$('.ms-live-data-load').attr('ms-live-link');


var html='';
 $.ajax({
    url: link,
    data: { 
        "TypeOfSearch": TypeOfSearch
 
    },
    cache: false,
    type: "GET",
    success: function(data) {

    	 jQuery.each(data.data,function (index, item){

        console.log(index);
			html=html+'<option value="'+index+'">' +item+'</option>';

    	 	$('.ms-live-data-load').html(html);



    	 });

    	// console.log(html);

    },
    error: function(xhr) {
    	html='';
    	$('.ms-live-data-load').html(html);

    }
});
  

});



$( ".ms-search-btn" ).click(function() {
loadingOn();
$('.ms-search-result').slideUp();
//alert( TypeOfSearch );
var TypeOfSearch=$("#SearchBy").val();
var QueryText=$("#QueryText").val();
//console.log(QueryText);
var link=$(".ms-search-result").attr('ms-live-link');


 var formData = new FormData();
    formData.append( "TypeOfSearch", TypeOfSearch );
    formData.append( "QueryText", QueryText );



            $.ajax({
                url: link,  //server script to process data
                type: 'POST',
             //   dataType:'json',
                xhr: function() {  // custom xhr
                    myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){ // if upload property exists
                       // myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // progressbar
                    }
                    return myXhr;
                },
                // Ajax events
                success: completeHandler = function(data) {
                

                    //console.log(data);

                     $(".ms-search-result").html(data.Data);

                },
                error: errorHandler = function(xhr,status, error) {
               



                },
                // Form data
                data:formData,
                // Options to tell jQuery not to process data or worry about the content-type
                cache: false,
                contentType: false,
                processData: false
            }).done(function (){

$('.ms-search-result').slideDown();
loadingOff()});


});


$('#QueryText').change(function(){


    $('.ms-search-btn').trigger('click') ;


});


</script>


</div>