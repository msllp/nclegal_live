<?php
 

  $data['form-action-para']=[


    'TaskId'=>\MS\Core\Helper\Comman::en4url($data['TaskId']),
   // 'StepId'=>\MS\Core\Helper\Comman::en4url($data['StepId']),


    ];
    $data['form-action']=route('TMS.Task.Rise.Step.Query.Action.Post',$data['form-action-para']);


    //dd(count($data['stepData']['DocumentArray']));
    $noQuery=[];
        if(count($data['stepData'] ['DocumentQueryArray']) != count($data['stepData']['DocumentArray'])){

          

      foreach ($data['stepData']['DocumentArray'] as $key => $value) {
        
        
        if(!array_key_exists($value['UniqId'], $data['stepData']['DocumentQueryArray']))  

      {  $tempCode=\MS\Core\Helper\Comman::random(3);
      
              $data['stepData']['DocumentQueryArray'][(string)$value['UniqId']][$tempCode]=[
      
              'Query'=>null,
              'Replay'=>null,
              "QueryStatus" => false,
              "QueryDocumentArray"=>[$value],
      
      
              ];

               $noQuery[$value['UniqId']]=true;
      
       // $noQuery=
              $data['stepData']['DocumentQueryArray'][$value['UniqId']][$tempCode]['QueryDocumentArray'][0]['FileName']=$key;
      }
       // dd($data['stepData']['DocumentQueryArray']);

      }
    }






 ?>

<div class="panel panel-info" >


      {!! Form::open(['url' => $data['form-action'],'method' => 'post','files' => true,'class'=>'ms-form ','role'=>'form']) !!}
     

<div class="panel-heading"><h5><strong> <i class="glyphicon glyphicon-home"></i> View Details for Task No.{{$data['TaskId']}} for Step No.{{$data['StepId']}} </strong></h5></div>
<div class="panel-body">
  

  <span class="col-lg-12">
    
        @include('B.L.Object.Error')
      </span>
</div>


  <table class="table table-bordered text-capitalize">

<tr>
<th colspan="7"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Current step documents that required action </th>
</tr>

  <tr>
    <th>Step Id</th>
    <th>File Name</th>
    <th>Type of Document</th>
    <th>Query</th>
    <th>Document Details</th>
  <th>Query Replay</th>
   <th>Document Replay</th>
    

  </tr>



 @foreach($data['stepData']['DocumentQueryArray']  as $docName=>$docDetails)
  


      @foreach($docDetails  as $docName1=>$docDetails1)





@foreach($docDetails1['QueryDocumentArray']  as $keyDoc=>$query)



  <tr class="info">
    
   <!--    
       <td>  {{  $data['StepId'] }}</td>    -->   


       <td> {{ $data['StepId'] }} </td>
       <td> 
       <?php


        if($docDetails1['QueryStatus']){
                            $docPath=(array)$data['stepData']['DocumentReplyArray'][ $query['UniqId'] ]['ReplayDocumentArray'];
                            $url=str_replace('\\' ,'/',$docPath['oldpath']);

                            }else{

                            $docPath=(array)$query;
                            $url=str_replace('\\' ,'/',$docPath['path']);

                            }
                            
                            $urlArray=explode('/',$url);
                            $c=\MS\Core\Helper\Comman::random(2);
                            array_splice($urlArray, 1, 0, $c);
                            $url=implode('/', $urlArray);


            $dataForRadio=[
'lable'=>explode('.',$query['FileName'])[0],

'name'=>'SelectedFiles['.$data['StepId'].']['.$query['UniqId'].']',
'data'=>[ 
              '1'=>'Approve',
              '0'=>'Reject',
              '2'=>'No Action'

],
'value'=>'2',
'ClassData'=>['form-class-div'=>'col-lg-12']


];



if(array_key_exists($query['UniqId'], $data['stepData']['DocumentVerifiedArray']) or $data['stepData']['DocumentVerified']){
 $dataForRadio['data']=[ '1'=>'Approved' ];
 $dataForRadio['value']='1';

}
if(array_key_exists($query['UniqId'], (array)$data['stepData']['DocumentRejectedArray'])){
 $dataForRadio['data']=[ '0'=>'Rejected' ];
 $dataForRadio['value']='0';

}

 $dataForRadio['editLock']=false;
 //$dataForRadio['name']=explode('.',last($urlArray))[0];
 $dataForRadio['ClassData']['form-class-div']="col-lg-12";
        ?>

        @if(count($dataForRadio['data'])>1)
        {{\Form::inputOption($dataForRadio,$loop->iteration)}}

        @else
        <?php  $dataForRadio['name']=explode('.',last($urlArray))[0]; ?>
        {{\Form::inputLockOption($dataForRadio,$loop->iteration)}}
        @endif
<?php unset($dataForRadio) ?>
        </td>
      <td> {{\B\ATMS\Logics::getTypeOfDocument( $query ['TypeOfDocument'] ) ['NameOfDocuments'] }}</td>
      <td>  {{ $docDetails1['Query'] }} </td>

      <td> 
<!-- Current Step Files -->


                  <table class="table table-bordered text-capitalize">

                   <tr>
                        
                            
                            
                            <td>



                                  <a class="btn btn-default" href="{{ route('TMS.Task.Get.File.Name',['UniqId'=>\MS\Core\Helper\Comman::en4url($c),'TaskId'=>\MS\Core\Helper\Comman::en4url($data['taskData']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($data ['StepId']),'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($docPath['TypeOfDocument']),'FileName'=>last($urlArray)]) }}" target="_BLANK">
                           

                          <i class="fa fa-paperclip" style="padding-right:5px;" aria-hidden="true"></i> {{ explode('.',last($urlArray))[0] }}
                         </a>
                         </td>
                         @if(array_key_exists('DateOfDocument', $query) && ($query['DateOfDocument']!=null))
                     
                         <td>
                           
                           {{ \Carbon::parse($query['DateOfDocument'])->format('d-m-Y') }}

                          
                         </td> 

                          @endif

                             @if(array_key_exists('NoOfDocument', $docPath)  && ($docPath['NoOfDocument']!=null))
                         <td>
                           
                           Invoice No.{{ $query['NoOfDocument'] }}
                           
                         </td> 

                          @endif

                          @if(array_key_exists('AmountOfDocument', $docPath)  && ($query['AmountOfDocument']!=null))
                         <td>
                           
                          Total Amount: ₹ {{ $query['AmountOfDocument'] }}
                           
                         </td> 

                          @endif




                         </tr>
                          
                       
                         
                         </table>
                   
       </td>




   <td> 
    @if($docDetails1['Replay']!=null)
      {{$docDetails1['Replay']}}
    @else
   
             @if( !array_key_exists($docName, $noQuery))
                  @if($data['stepData']['DocumentQuery'])
                  <div class="btn btn-warning ms-text-black" >
                                <i class="fa fa-refresh fa-spin fa-fw"></i>
                                Waiting For Agency Replay
                  </div>  
                   @endif
             @endif
    @endif
      </td>

        <td> 

            @if($docDetails1['Replay']!=null)
             
            <!-- Current Step New Files -->
              <table class="table table-bordered text-capitalize">

                
            
                 <tr>
                  <?php

//                  ['DocumentArray']
                  $docPath=(array)$data['stepData']['DocumentReplyArray'][ $query['UniqId'] ]['ReplayDocumentArray']  ;

                  $url=str_replace('\\' ,'/',$docPath['path']);
                  $urlArray=explode('/',$url);
                  $c=\MS\Core\Helper\Comman::random(2);

                  array_splice($urlArray, 1, 0, $c);
                  $url=implode('/', $urlArray);
                  $newFile="";
                  if(array_key_exists('Path', $docPath)){
                                   $newFile=last(explode("/",$docPath['Path']));}else{

                  $newFile=last(explode("/",$docPath['path']));

                                   }  

                 //;
                 // if('Panchnma Copy_452'==explode('.',$docName)[0])dd($docPath);
                   ?>
                  
                  
                  <td>



                        <a class="btn btn-default" href="{{ route('TMS.Task.Get.File.Name',['UniqId'=>\MS\Core\Helper\Comman::en4url($c),'TaskId'=>\MS\Core\Helper\Comman::en4url($data['taskData']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($data ['StepId']),'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($docPath['TypeOfDocument']),'FileName'=>$newFile]) }}" target="_BLANK">
                 

                 <i class="fa fa-paperclip" style="padding-right:5px;" aria-hidden="true"></i> {{ explode('.',last($urlArray))[0] }}
               </a>
               </td>
               @if(array_key_exists('DateOfDocument', $docPath) && ($docPath['DateOfDocument']!=null))
           
               <td>
                 
                 {{ \Carbon::parse($docPath['DateOfDocument'])->format('d-m-Y') }}

                
               </td> 

                @endif

                   @if(array_key_exists('NoOfDocument', $docPath)  && ($docPath['NoOfDocument']!=null))
               <td>
                 
                 Invoice No.{{ $docPath['NoOfDocument'] }}
                 
               </td> 

                @endif

                @if(array_key_exists('AmountOfDocument', $docPath)  && ($docPath['AmountOfDocument']!=null))
               <td>
                 
                Total Amount: ₹ {{ $docPath['AmountOfDocument'] }}
                 
               </td> 

                @endif




               </tr>
                
             
               
               </table>



            @else
            
            @if( !array_key_exists($docName, $noQuery))
                  @if($data['stepData']['DocumentQuery'])
                  <div class="btn btn-warning ms-text-black" >
                                <i class="fa fa-refresh fa-spin fa-fw"></i>
                                Waiting For Agency Replay
                  </div>  
                   @endif
            @endif


            @endif






         </td>

  </tr>




  @endforeach

  @endforeach




  @endforeach



  <tr>
  <th colspan="7"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i> Recent Query documents that required action </th>
  </tr>





<?php 



 \MS\Core\Helper\Comman::DB_flush();
 $m3=new \B\TMS\Model('1',$data['TaskId']);

 if($recentTask=$m3->where('DocumentVerified',0)->where('DocumentQuery',1)->orWhere('DocumentReply',1)->get() != null){
 $recentTask=$m3->where('DocumentVerified',0)-> where('DocumentQuery',1)->orWhere('DocumentReply',1)->get()->toArray();}else{$recentTask=[];}
  



?>


@if(count($recentTask)>0)
  @foreach(  $recentTask as $task ) 

  @if($task['UniqId'] != $data['StepId'])

  <?php 

    $task ['DocumentArray']=(array)json_decode($task ['DocumentArray'],true);
    $task ['DocumentVerifiedArray']=(array)json_decode($task ['DocumentVerifiedArray'],true);

    $task ['DocumentQueryArray']=(array)json_decode($task ['DocumentQueryArray'],true);
    $task ['DocumentReplyArray']=(array)json_decode($task ['DocumentReplyArray'],true);
    $task['DocumentRejectedArray']  =(array)json_decode($task ['DocumentRejectedArray'],true);

    $noQuery=[];

    if(count($task ['DocumentQueryArray']) != count($task ['DocumentArray'])){



      foreach ($task['DocumentArray'] as $key => $value) {
        
        
        if(!array_key_exists($value['UniqId'], $task['DocumentQueryArray']))  

      {  $tempCode=\MS\Core\Helper\Comman::random(2);
      
              $task['DocumentQueryArray'][$value['UniqId']][$tempCode]=[
      
              'Query'=>null,
              'Replay'=>null,
              "QueryStatus" => true,
              "QueryDocumentArray"=>[$value],
      
      
              ];

        $noQuery[$value['UniqId']]=true;
      
      
              $task['DocumentQueryArray'][$value['UniqId']][$tempCode]['QueryDocumentArray'][0]['FileName']=$key;
      }
        //dd($task['DocumentQueryArray']);

      }
    }


  ?>

    @foreach($task['DocumentQueryArray']  as $docName=>$docDetails)
  

      @foreach($docDetails  as $docName1=>$docDetails1)
        @foreach($docDetails1['QueryDocumentArray']  as $keyDoc=>$query)

<tr class="warning">
    
   <!--    
       <td>  {{  $data['StepId'] }}</td>    -->   


       <td> {{$task['UniqId'] }} </td>
       <td>
         
          <?php


           if($docDetails1['QueryStatus']  && array_key_exists($query['UniqId'], (array)$task ['DocumentReplyArray'])){


            
                              $docPath=(array)$task ['DocumentReplyArray'][ $query['UniqId'] ]['ReplayDocumentArray'];


                              $docPath2=(array)current($docDetails1['QueryDocumentArray' ]);
                             

                            $url=str_replace('\\' ,'/',$docPath['oldpath']);


                          //  dd($task);

                            }else{

                            $docPath=(array)$query;
                            $docPath2=(array)$query;
                            $url=str_replace('\\' ,'/',$docPath['path']);

                            }
                  $urlArray=explode('/',$url);
                  $c=\MS\Core\Helper\Comman::random(2);
                  array_splice($urlArray, 1, 0, $c);
                  $url=implode('/', $urlArray);






            $dataForRadio=[
'lable'=>explode('.',$query['FileName'])[0],

'name'=>'SelectedFiles['.$task['UniqId'].']['.$query['UniqId'].']',
'data'=>[ 
              '1'=>'Approve',
              '0'=>'Reject',
              '2'=>'No Action'

],
'value'=>'2',
'ClassData'=>['form-class-div'=>'col-lg-12']


];


if(array_key_exists($query['UniqId'], $task['DocumentVerifiedArray']) or $task['DocumentVerified']){
 $dataForRadio['data']=[ '1'=>'Approved' ];
 $dataForRadio['value']='1';

}
if(array_key_exists($query['UniqId'], (array)$task['DocumentRejectedArray'])){
 $dataForRadio['data']=[ '0'=>'Rejected' ];
 $dataForRadio['value']='0';

}

 $dataForRadio['editLock']=false;
 //$dataForRadio['name']=explode('.',last($urlArray))[0];
 $dataForRadio['ClassData']['form-class-div']="col-lg-12";


        ?>
        @if(count($dataForRadio['data'])>1)
        {{\Form::inputOption($dataForRadio,$loop->iteration)}}

        @else
        <?php  $dataForRadio['name']=explode('.',last($urlArray))[0]; ?>
        {{\Form::inputLockOption($dataForRadio,$loop->iteration)}}
        @endif

             </td>

      <td> {{\B\ATMS\Logics::getTypeOfDocument( $query ['TypeOfDocument'] ) ['NameOfDocuments'] }}</td>
      <td>  {{ $docDetails1['Query'] }} </td>

      <td> 

                     <table class="table table-bordered text-capitalize">

                
            
                 <tr>
            
                  
                  <td>
<a class="btn btn-default" href="{{ route('TMS.Task.Get.File.Name',['UniqId'=>\MS\Core\Helper\Comman::en4url($c),'TaskId'=>\MS\Core\Helper\Comman::en4url($data['taskData']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($data ['StepId']),'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($docPath['TypeOfDocument']),'FileName'=>last($urlArray)]) }}" target="_BLANK">
                 <i class="fa fa-paperclip" style="padding-right:5px;" aria-hidden="true"></i> {{ explode('.',last($urlArray))[0] }}
               </a>
               </td>
               @if(array_key_exists('DateOfDocument', $docPath2) && ($docPath2['DateOfDocument']!=null))
           
               <td>
                 
                 {{ \Carbon::parse($docPath2['DateOfDocument'])->format('d-m-Y') }}

                
               </td> 

                @endif

                   @if(array_key_exists('NoOfDocument', $docPath2)  && ($docPath2['NoOfDocument']!=null))
               <td>
                 
                 Invoice No.{{ $docPath2['NoOfDocument'] }}
               </td> 

                @endif

                @if(array_key_exists('AmountOfDocument', $docPath2)  && ($docPath2['AmountOfDocument']!=null))
               <td>
                 
                Total Amount: ₹ {{ $docPath2['AmountOfDocument'] }}

               </td> 

                @endif




               </tr>
                
             
               
               </table>

       </td>




   <td> 
    @if($docDetails1['Replay']!=null)
      {{$docDetails1['Replay']}}
    @else




         @if( !array_key_exists($docName, $noQuery))
                     @if($task['DocumentQuery'])
                       <div class="btn btn-warning ms-text-black" >
                          <i class="fa fa-refresh fa-spin fa-fw"></i>
                          Waiting For Agency Replay
                        </div>  
            @endif
            @endif

  
    @endif
      </td>

        <td> 

            @if($docDetails1['Replay']!=null)
              
                                     <table class="table table-bordered text-capitalize">

                
            
                 <tr>
                  <?php
                 if($docDetails1['QueryStatus']  && array_key_exists($query['UniqId'], (array)$task ['DocumentReplyArray'])){
                              $docPath=(array)$task ['DocumentReplyArray'][ $query['UniqId'] ]['ReplayDocumentArray'];
                            $url=str_replace('\\' ,'/',$docPath['path']);

                            }
                  $urlArray=explode('/',$url);
                  $c=\MS\Core\Helper\Comman::random(2);
                  array_splice($urlArray, 1, 0, $c);
                  $url=implode('/', $urlArray);
           //     dd($docPath);  

                 //;
                 // if('Panchnma Copy_452'==explode('.',$docName)[0])dd($docPath);
                   ?>
                  
                  
                  <td>
<a class="btn btn-default" href="{{ route('TMS.Task.Get.File.Name',['UniqId'=>\MS\Core\Helper\Comman::en4url($c),'TaskId'=>\MS\Core\Helper\Comman::en4url($data['taskData']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($data ['StepId']),'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($docPath['TypeOfDocument']),'FileName'=>last($urlArray)]) }}" target="_BLANK">
                  <i class="fa fa-paperclip" style="padding-right:5px;" aria-hidden="true"></i> {{ explode('.',last($urlArray))[0] }}
               </a>
               </td>
               @if(array_key_exists('DateOfDocument', $docPath) && ($docPath['DateOfDocument']!=null))
           
               <td>
                 
                 {{ \Carbon::parse($docPath['DateOfDocument'])->format('d-m-Y') }}

                
               </td> 

                @endif

                   @if(array_key_exists('NoOfDocument', $docPath)  && ($docPath['NoOfDocument']!=null))
               <td>
                 
                 Invoice No.{{ $docPath['NoOfDocument'] }}
                 
               </td> 

                @endif

                @if(array_key_exists('AmountOfDocument', $docPath)  && ($docPath['AmountOfDocument']!=null))
               <td>
                 
                Total Amount: ₹ {{ $docPath['AmountOfDocument'] }}
                 
               </td> 

                @endif




               </tr>
                
             
               
               </table>




            @else
           @if( !array_key_exists($docName, $noQuery))
                     @if($task['DocumentQuery'])
                       <div class="btn btn-warning ms-text-black" >
                          <i class="fa fa-refresh fa-spin fa-fw"></i>
                          Waiting For Agency Replay
                        </div>  
            @endif
            @endif
            @endif






         </td>

  </tr>

        @endforeach
      @endforeach
    @endforeach
    @endif

  @endforeach
@endif


  <tr>
  <th colspan="7"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i>Unverified Documents </th>
  </tr>



<?php 



 \MS\Core\Helper\Comman::DB_flush();
 $m3=new \B\TMS\Model('1',$data['TaskId']);
//dd($m3->where([['DocumentVerified','=',0] , ['DocumentQuery','=',0],['TypeOfAction','=',3] , ['DocumentReply','=',0]])->get()->toArray());

 if($m3->where([['DocumentVerified','=',0] , ['DocumentQuery','=',0],['TypeOfAction','=',3] , ['DocumentReply','=',0]])->get() != null){
 $recentTask=$m3->where([['DocumentVerified','=',0] , ['DocumentQuery','=',0],['TypeOfAction','=',3] , ['DocumentReply','=',0]])->get()->toArray();}else{$recentTask=[];}
  

?>


@if(count($recentTask)>0)
  @foreach(  $recentTask as $task ) 

  @if($task['UniqId'] != $data['StepId'])

  <?php 

    $task ['DocumentArray']=(array)json_decode($task ['DocumentArray'],true);
    $task ['DocumentVerifiedArray']=(array)json_decode($task ['DocumentVerifiedArray'],true);

    $task ['DocumentQueryArray']=(array)json_decode($task ['DocumentQueryArray'],true);
    $task ['DocumentReplyArray']=(array)json_decode($task ['DocumentReplyArray'],true);
    $task['DocumentRejectedArray']  =(array)json_decode($task ['DocumentRejectedArray'],true);

  ?>

    @foreach($task['DocumentArray']  as $docName=>$docDetails)
  
    
  
<tr class="warning">
    
   <!--    
       <td>  {{  $data['StepId'] }}</td>    -->   


       <td> {{$task['UniqId'] }} </td>
       <td>
         
          <?php

                         $query=$docDetails;


                            $docPath=(array)$query;
                            $url=str_replace('\\' ,'/',$docPath['path']);

                  $urlArray=explode('/',$url);
                  $c=\MS\Core\Helper\Comman::random(2);
                  array_splice($urlArray, 1, 0, $c);
                  $url=implode('/', $urlArray);






            $dataForRadio=[
'lable'=>explode('.',$docName)[0],

'name'=>'SelectedFiles['.$task['UniqId'].']['.$query['UniqId'].']',
'data'=>[ 
              '1'=>'Approve',
              '0'=>'Reject',
              '2'=>'No Action'

],
'value'=>'2',
'ClassData'=>['form-class-div'=>'col-lg-12']


];
if(array_key_exists($query['UniqId'], $task['DocumentVerifiedArray']) or $task['DocumentVerified']){
 $dataForRadio['data']=[ '1'=>'Approved' ];
 $dataForRadio['value']='1';

}
if(array_key_exists($query['UniqId'], (array)$task['DocumentRejectedArray'])){
 $dataForRadio['data']=[ '0'=>'Rejected' ];
 $dataForRadio['value']='0';

}

 $dataForRadio['editLock']=false;

 $dataForRadio['ClassData']['form-class-div']="col-lg-12";


        ?>
        @if(count($dataForRadio['data'])>1)
        {{\Form::inputOption($dataForRadio,$loop->iteration)}}

        @else
        <?php  $dataForRadio['name']=explode('.',last($urlArray))[0]; ?>
        {{\Form::inputLockOption($dataForRadio,$loop->iteration)}}
        @endif



       </td>

      <td> {{\B\ATMS\Logics::getTypeOfDocument( $query ['TypeOfDocument'] ) ['NameOfDocuments'] }}</td>


      <td colspan="4"> 

                     <table class="table table-bordered text-capitalize">

                
            
                 <tr>
            
                  
                  <td>
<a  class="btn btn-default" href="{{ route('TMS.Task.Get.File.Name',['UniqId'=>\MS\Core\Helper\Comman::en4url($c),'TaskId'=>\MS\Core\Helper\Comman::en4url($data['taskData']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($data ['StepId']),'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($docPath['TypeOfDocument']),'FileName'=>last($urlArray)]) }}" target="_BLANK">
               <i class="fa fa-paperclip" style="padding-right:5px;" aria-hidden="true"></i>  {{ explode('.',last($urlArray))[0] }}
               </a>
               </td>
               @if(array_key_exists('DateOfDocument', $docPath) && ($docPath['DateOfDocument']!=null))
           
               <td>
                 
                 {{ \Carbon::parse($docPath['DateOfDocument'])->format('d-m-Y') }}

                
               </td> 

                @endif

                   @if(array_key_exists('NoOfDocument', $docPath)  && ($docPath['NoOfDocument']!=null))
               <td>
                 
                 Invoice No.{{ $docPath['NoOfDocument'] }}
                
               </td> 

                @endif

                @if(array_key_exists('AmountOfDocument', $docPath)  && ($docPath['AmountOfDocument']!=null))
               <td>
                 
                Total Amount: ₹ {{ $docPath['AmountOfDocument'] }}
                
               </td> 

                @endif




               </tr>
                
             
               
               </table>

       </td>





  </tr>

       
    @endforeach
    @endif

  @endforeach
@endif






  </table>

<div class="panel-footer">
  


  <div class="btn-group btn-group-justified" >
                              
                      <?php 
             
                      $link="TMS.Task.View.Id";
                   

                 

                      ?>  

           <div class="btn btn-default ms-text-black ms-mod-btn" ms-shortcut="back" ms-live-link="{{ route($link,['UniqId'=>\MS\Core\Helper\Comman::en4url($data['TaskId']) ]) }}"><i class="fa fa-fast-backward"  ></i> Go Back to Task Overview No. {{$data['TaskId']}}</div>
           <div class="btn btn-success ms-text-black btn-frm-submit" ><i class="fa fa-check"  ></i> Save  </div>
           
                            </div>
</div>


    {!! Form::close() !!}

  </div>


  <script type="text/javascript">


  @include('L.jsFix')

  </script>