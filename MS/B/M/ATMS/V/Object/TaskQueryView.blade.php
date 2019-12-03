<?php
 

  $data['form-action-para']=[


    'TaskId'=>\MS\Core\Helper\Comman::en4url($data['TaskId']),
    'StepId'=>\MS\Core\Helper\Comman::en4url($data['StepId']),


    ];
    $data['form-action']=route('ATMS.Task.Rise.Step.Replay.Post',$data['form-action-para']);

      
    //  $docArray=current(current($data['stepData']['DocumentQueryArray']));

 // dd($data);

 ?>


<div class="panel panel-info" >



<div class="panel-heading"><h5><strong> <i class="glyphicon glyphicon-home"></i> View Query for Task No.{{$data['TaskId']}} for Step No.{{$data['StepId']}} </strong></h5></div>
<div class="panel-body">
  

  <span class="col-lg-12">
    
        @include('B.L.Object.Error')
      </span>
</div>


  <table class="table table-bordered text-capitalize">



  <tr>

  	<th>Type of Document</th>
  	<th>Documents Details</th>
  <th>Query</th>
   <th>Replay</th>

      <th>Replay Documents Details</th>

      <th>Current Status</th>
  	

  </tr>




 @foreach($data['stepData']['DocumentQueryArray']  as $docName=>$docDetails)
  

      @foreach($docDetails  as $docName1=>$docDetails1)



@foreach($docDetails1['QueryDocumentArray']  as $keyDoc=>$query)




  <tr class="info">
    
   <!--    
       <td>  {{  $data['StepId'] }}</td>    -->   

      <td> {{\B\ATMS\Logics::getTypeOfDocument( $query ['TypeOfDocument'] ) ['NameOfDocuments'] }}</td>

      <td> 

                     <table class="table table-bordered text-capitalize">

                
            
                 <tr>
                  <?php
                  $docPath=(array)$query;

                  $url=str_replace('\\' ,'/',$docPath['path']);
                  $urlArray=explode('/',$url);
                  $c=\MS\Core\Helper\Comman::random(2);
                  array_splice($urlArray, 1, 0, $c);
                  $url=implode('/', $urlArray);
                  
                  $fileName=$query['FileName'];    

                  if($docDetails1['QueryStatus']){

                    //dd($data['stepData']['DocumentReplyArray'][$docPath['UniqId']]);

                    $fileName=last(explode('\\',$data['stepData']['DocumentReplyArray'][$docPath['UniqId']]['ReplayDocumentArray']['oldpath']));
                  //  dd($fileName);

                  }


                  ?>
                  
                  
                  <td>

<a href="{{ route('ATMS.Task.Get.File.Name',['UniqId'=>\MS\Core\Helper\Comman::en4url($c),'TaskId'=>\MS\Core\Helper\Comman::en4url($data['taskData']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($data ['StepId']),'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($docPath['TypeOfDocument']),'FileName'=>$fileName]) }}" target="_BLANK">
                 {{ explode('.',$fileName)[0] }}
               </a>


               </td>
               
               @if(array_key_exists('DateOfDocument', $docPath) && ($docPath['DateOfDocument']!=null))
           
               <td>
                 
                 {{ \Carbon::parse($docPath['DateOfDocument'])->format('d-m-Y') }}

                 <br>
               
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


  <?php 


//dd();
  $dataFortextarea=[
'lable'=>'Write your query  Replay here',

'name'=>'SelectedFilesQuery['.$data["StepId"].']['.$docPath["UniqId"].'][query]',
'value'=>'',
'data'=>['input-size'=>'col-lg1-12'],
  ];


  // dd( $docDetails1);
  ?>  

      <td>  {{$docDetails1['Query']}}</td>

        <td> 

        @if($docDetails1['QueryStatus'])

        {{ $data['stepData']['DocumentReplyArray'][$docPath["UniqId"]]['Replay'] }}

        @else

        <div class="btn btn-warning ms-text-black ">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            Query Raised Replay Required
         </div>
        @endif

         </td>

      <td> 


            @if($docDetails1['QueryStatus'])


                     <table class="table table-bordered text-capitalize">

                
            
                 <tr>
                  <?php


                  $docPath=(array)$query;

                  $docPath=$data['stepData']['DocumentReplyArray'][ $docPath['UniqId']]['ReplayDocumentArray'];
                 // dd($data['stepData']['DocumentReplyArray'][ $docPath['UniqId']]['ReplayDocumentArray']);

                  $url=str_replace('\\' ,'/',$docPath['path']);
                  $urlArray=explode('/',$url);
                  $c=\MS\Core\Helper\Comman::random(2);
                  array_splice($urlArray, 1, 0, $c);
                  $url=implode('/', $urlArray);
           //     dd($docPath);  

                 //;
                 // if('Panchnma Copy_452'==explode('.',$docName)[0])dd($docPath);
                   ?>
                  
                  
                  <td>
<a href="{{ route('ATMS.Task.Get.File.Name',['UniqId'=>\MS\Core\Helper\Comman::en4url($c),'TaskId'=>\MS\Core\Helper\Comman::en4url($data['taskData']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($data ['StepId']),'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($docPath['TypeOfDocument']),'FileName'=>$query['FileName']]) }}" target="_BLANK">
                 {{ explode('.',$query['FileName'])[0] }}
               </a>
               </td>
               @if(array_key_exists('DateOfDocument', $docPath) && ($docPath['DateOfDocument']!=null))
           
               <td>
                 
                 {{ \Carbon::parse($docPath['DateOfDocument'])->format('d-m-Y') }}

                 <br>
                
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

        <div class="btn btn-warning ms-text-black ">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            Query Riased Replay Required
         </div>
        @endif

       </td>


  </tr>




  @endforeach

  @endforeach




  @endforeach




  </table>

<div class="panel-footer">
	


	<div class="btn-group btn-group-justified" >
                              
                      <?php 
             
                      $link="ATMS.Task.View.Id";
                   

                 

                      ?>  

					 <div class="btn btn-default ms-text-black ms-mod-btn" ms-live-link="{{ route($link,['UniqId'=>\MS\Core\Helper\Comman::en4url($data['TaskId']) ]) }}"><i class="fa fa-fast-backward"  ></i> Go Back to Task Overview No. {{$data['TaskId']}}</div>
        

                            </div>
</div>




  </div>


  <script type="text/javascript">


  @include('L.jsFix')

  </script>