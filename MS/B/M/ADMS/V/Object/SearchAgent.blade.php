<div class="panel panel-info" >



    <div class="panel-heading"><h5><strong> <i class="fa fa-search"></i>Search & View Bills Up Agent</strong></h5></div>
    <div class="panel-body">

        <?php
        $dataForOption=[
            'lable'=>'Search By',

            'name'=>'SearchBy',
            'data'=>[
                '0'=>'Agency',
                //'1'=>'Task ID',
                // '2'=>'States',
                // '3'=>"Month",



            ],
            'value'=>'0',
            'ClassData'=>['form-class-div'=>'col-lg-3']


        ];




        ?>
        {{\Form::inputOption($dataForOption)}}


        <?php

        \MS\Core\Helper\Comman::DB_flush();
        $m2=new \B\AMS\Model();

        $allAganecyData=$m2->MS_all()->pluck('Name','UniqId')->toArray();
        $allAganecyDataRaw=$m2->MS_all()->groupBy('UniqId')->toArray();
        //dd($allAganecyDataRaw);
        $Agenctdata=[];

            $m3=new \B\ADMS\Model(1);
            $allIBillTable=array_flip(\DB::connection($m3->getConnectionName())->getDoctrineSchemaManager()->listTableNames());

            foreach ($allIBillTable as $key=>$value){

            $tableExo=explode('_',$key);

            if(!array_key_exists($tableExo[2],$Agenctdata))$Agenctdata[$tableExo[2]]=$allAganecyData[$tableExo[2]];






        }





       

        ?>
        <div class="form-group col-lg-3">

            <label for="QueryText">Select</label>

            <select class="form-control ms-live-data-load" ms-live-link="{{ route('ADMS.Agent.Bill.Search.Data') }}" id="QueryText" name="QueryText">

                @foreach($Agenctdata as  $code=>$text )


                    <option value="{{ $code }}">{{ $text }}</option>


                @endforeach

            </select>

        </div>


         <?php
        $dataForOption=[
            'lable'=>'Agent/Task By',

            'name'=>'SearchBy1',
            'data'=>[
               // '0'=>'Agency',
                //'1'=>'Task ID',
                // '2'=>'States',
                // '3'=>"Month",



            ],
            'value'=>'0',
            'ClassData'=>['form-class-div'=>'col-lg-3']


        ];




        ?>
        {{\Form::inputOption($dataForOption)}}





        <div class="btn btn-info col-lg-3 ms-text-black ms-search-btn hidden-print" style="margin-top:10px;"><i class="fa fa-search" aria-hidden="true"></i> <br>Search</div>
        <br>

        <div class="panel panel-default col-lg-12" style="padding-left:0px;padding-right: 0px;">

            <div class="panel-heading"> Search Result </div>
            <div class="panel-body  ms-search-result" ms-live-link=" {{ route('ADMS.Agent.Bill.Search') }} " ms-live-link-2=" {{ route('ADMS.Agent.Bill.Search.2') }} "></div>

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

            console.log($('#SearchBy1').val());
            //alert($('#SearchBy1').val());


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