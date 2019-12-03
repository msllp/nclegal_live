<div class="panel panel-info" >



<div class="panel-heading"><h5><strong> <i class="glyphicon glyphicon-home"></i> Search Task </strong></h5></div>
<div class="panel-body">

<?php 
$dataForOption=[
'lable'=>'Search By',

'name'=>'SearchBy',
'data'=>[ 
              '0'=>'Agency',
              '1'=>'Status',
              '2'=>"Piracy Network's State",
              '3'=>'Month'


],
'value'=>'1',
'ClassData'=>['form-class-div'=>'col-lg-4']


];




        ?>
{{\Form::inputOption($dataForOption)}}


<?php 

\MS\Core\Helper\Comman::DB_flush();
                    $m2=new \B\TMS\Model(6);

                    $mData=$m2->MS_all()->pluck('NameOfAction','UniqId');

                    //dd($mData);

                    \MS\Core\Helper\Comman::DB_flush();
                    $m1=new \B\TMS\Model(0);


                    $data=$m1->get()->groupBy('CurrentStatus')->toArray();
                    //dd();

                    $types=array_keys($data);

                    
                    $m=[];

                    foreach ($types as $value) {
                        
                        $m[$mData[$value]]=$mData[$value];


                    }


  ?>
<div class="form-group col-lg-4">

<label for="QueryText">Select</label> 

<select class="form-control ms-live-data-load" ms-live-link="{{ route('MSCDN.search.Task.get.Data') }}" id="QueryText" name="QueryText">
    
@foreach($m as $value=>$title)
<option value="{{$value}}">{{$title}}</option>

@endforeach

</select>

</div>






<div class="btn btn-info col-lg-4 ms-text-black ms-search-btn" style="margin-top:10px;"><i class="fa fa-search" aria-hidden="true"></i> <br>Search</div>
	<br>

<div class="panel panel-default col-lg-12" style="padding-left:0px;padding-right: 0px;">
	
<div class="panel-heading"> Search Result </div>
<div class="panel-body  ms-search-result" ms-live-link=" {{ route('TMS.Task.Search.Post') }} "></div>

</div>



</div>

<script type="text/javascript">
	

	$( "[name=SearchBy]" ).change(function() {
  	//alert( $("option:selected").val()  );

    $('.ms-search-result').slideUp();
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

			html=html+'<option value="'+item+'">' +item+'</option>';

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
$('.ms-search-result').slideUp('fast');
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
loadingOff();

            });


});


$('#QueryText').change(function(){


    $('.ms-search-btn').trigger('click') ;


});


</script>


</div>