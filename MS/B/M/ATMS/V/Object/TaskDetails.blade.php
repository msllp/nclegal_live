<div class="panel panel-info" >
      <?php 
      
      $userRole=0;
              if(session('user.SuperAdmin')){
                      $userRole=1;
                      }elseif (session('user.AgencyAdmin')) {
                      $userRole=2;
                      }else{
                      $userRole=0;
                      }


                    //  dd($data);
                      ?>
                    
                        <div class="panel-heading text-capitalize"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Task. {{  $data['task']['UniqId'] }}
                        

                        </div>
                      
                        <div class="panel-body" >

                          <span class="col-lg-12">

      </span>
                         <table class="table table-bordered text-capitalize">
              
              <tr>

              
                <th>Task No </th>
                <td>: {{$data['task']['UniqId']}}</td>

               
              </tr> 


  




              <tr>
                
                <th>Name of Operator</th>
                <td>: {{$data['task']['NameOperator']}}</td>

               
              </tr>   


              <tr>
                    <?php

              // dd($data);
                  
                  $address='';

                  if($data['task']['NameOperatorAddress1'] != null or  $data['task']['NameOperatorAddress1'] !=' ' )$address.=$data['task']['NameOperatorAddress1'];
                  if($data['task']['NameOperatorAddress2'] != null or  $data['task']['NameOperatorAddress2'] !=' ' )$address.=",".$data['task']['NameOperatorAddress2'];
                  if($data['task']['NameOperatorAddress3'] != null or  $data['task']['NameOperatorAddress3'] !=' ' )$address.=",".$data['task']['NameOperatorAddress3'];

                  $address.=",".$data['task']['NameOperatorCity'].",".$data['task']['NameOperatorDistrict'].",".$data['task']['NameOperatorState']."-".$data['task']['NameOperatorPincode']

                 ?>


                <th>Location of Control Room</th>
   
                <td>: {{$address}}</td>

              </tr>                       

              <tr>
                
             
                          <?php

  
                  $Paddress='';

                  if($data['task']['NameAreaPiracyCity'] != null or  $data['task']['NameAreaPiracyCity'] !=' ' )$Paddress.=$data['task']['NameAreaPiracyCity'];
                  if($data['task']['NameAreaPiracyDistrict'] != null or  $data['task']['NameAreaPiracyDistrict'] !=' ' )$Paddress.=",".$data['task']['NameAreaPiracyDistrict'];
                  if($data['task']['NameAreaPiracyState'] != null or  $data['task']['NameAreaPiracyState'] !=' ' )$Paddress.=",".$data['task']['NameAreaPiracyState'];
                  if($data['task']['NameAreaPiracyPincode'] != null or  $data['task']['NameAreaPiracyPincode'] !=' ' )$Paddress.="-".$data['task']['NameAreaPiracyPincode'];

                //  $Paddress.=$data['task']['NameOperatorCity'].",".$data['task']['NameOperatorDistrict'].",".$data['task']['NameOperatorState']."-".$data['task']['NameOperatorPincode']

                 ?>

                <th>Area of Piracy</th>
                <td>:  {{$Paddress}} </td>
              
              </tr>   



                <tr>
                
                <th>Illegal broadcasting </th>
                <td>: {{$data['task']['IllegalTypeBroadcasting']}}</td>

              
              </tr>    



                <tr>
                
                <th>Status of Operator </th>
                <td>: {{$data['task']['StatusOperator']}}</td>

              
              </tr>  


                 <tr>
                
                <th>Mode of Piracy </th>
                <td>: {{$data['task']['ModePiracy']}} </td>

              
              </tr>  





                                  


                        </table>




              <h5>Task Current Status</h5>
              <table class="table table-bordered text-capitalize">
                
              <th> No. </th>
              <th> Type of Action</th>
              <th> Action Taken by </th>
              <th>Documents</th>
              <th>Action</th>
              <th> Date </th>

              @foreach($data['taskDetaisls'] as $step)
              <tr>
                
                
                <td>{{$loop->iteration}}</td>
                <td> {{ \B\TMS\Logics::getTypeOfAction($step['TypeOfAction'])['NameOfAction'] }} </td>

                @if(\B\Users\Logics::getUserName($step['TakenBy']))


                <td> {{ \B\Users\Logics::getUserName($step['TakenBy'])  }} ( Admin )</td>


                @elseif(\B\AMS\Logics::getUserName($step['TakenBy']))

                <td> {{ \B\AMS\Logics::getUserName($step['TakenBy']) }} ( Agency )  </td>

                @else

                <td> No Data Found  {{ $step['TakenBy'] }} </td>
                @endif


                <td>
                @if($step['DocumentUploaded'])

                <?php
                
                $documentArray=(array)json_decode($step['DocumentArray']);
                $documenyArrayVeri=(array)json_decode($step['DocumentVerifiedArray']);
                
                $DocumentQuery=$step['DocumentQuery'];


                 ?>


   
              <table class="table table-bordered text-capitalize table-hover table-condensed table-responsive">

                
                 @foreach($documentArray as $docName=>$docPath )
                 
                 <tr>
                  <?php
                  $docPath=(array)$docPath;

                  $url=str_replace('\\' ,'/',$docPath['path']);
                  $urlArray=explode('/',$url);
                  $c=\MS\Core\Helper\Comman::random(2);
                  array_splice($urlArray, 1, 0, $c);
                  $url=implode('/', $urlArray);
                // dd($docPath );  

                 //;
                 // if('Panchnma Copy_452'==explode('.',$docName)[0])dd($docPath);
                   ?>
                  
                  
                  <td>

<a href="{{ route('ATMS.Task.Get.File.Name',['UniqId'=>\MS\Core\Helper\Comman::en4url($c),'TaskId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId']),'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($docPath['TypeOfDocument']),'FileName'=>$docName]) }}" target="_BLANK">
                 {{ explode('.',$docName)[0] }}
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
                
                 @endforeach
               
               </table>
              








                 @else

                 No Document Uploaded

                @endif
                </td>


                <td>
                  

               @if($step['DocumentVerified'])
                  
              <div class="btn-group btn-group-xs">

                  @if($step['DocumentVerified'] == 1)
                   
                  <div class="btn btn-success ms-text-white "> <i class="fa fa-check"></i> Verified by 


                     @if(\B\Users\Logics::getUserName($step['VerifiedBy']))


              {{ \B\Users\Logics::getUserName($step['VerifiedBy'])  }} ( Admin )


                @elseif(\B\AMS\Logics::getUserName($step['VerifiedBy']))

              {{ \B\AMS\Logics::getUserName($step['VerifiedBy']) }} ( Agency ) 

                @else

           No Data Found  {{ $step['VerifiedBy'] }} 
                @endif

                    </div>

                   


                    @elseif($step['DocumentVerified'] == 3)


                  
                  <div class="btn btn-danger ms-text-white "> <i class="fa fa-times"></i> Rejected by 


                     @if(\B\Users\Logics::getUserName($step['VerifiedBy']))


              {{ \B\Users\Logics::getUserName($step['VerifiedBy'])  }} ( Admin )


                @elseif(\B\AMS\Logics::getUserName($step['VerifiedBy']))

              {{ \B\AMS\Logics::getUserName($step['VerifiedBy']) }} ( Agency ) 

                @else

           No Data Found  {{ $step['VerifiedBy'] }} 
                @endif

                    </div>


                    @endif

                    </div>

               @else

               @if($step['DocumentUploaded'])



               <div class="btn-group btn-group-xs text-justified">

               @if(!$DocumentQuery)



               <?php 



             $step['DocumentReplyArray']  =json_decode($step['DocumentReplyArray'],true);
             $step['DocumentQueryArray']  =json_decode($step['DocumentQueryArray'],true);



               ?>
                          
                        @if($step['DocumentReply'])

                          <?php

                         
                           // dd($step['DocumentReplyArray']);
                           ?>

                        <div class="btn btn-info ms-text-black ms-mod-btn" ms-live-link="{{ route('ATMS.Task.Rise.Step.View',['TaskId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId'])])  }}">
                          <i class="fa fa-eye"></i>
                          View Query 
                        </div>   

                      
                        @if(!$step['DocumentVerified'])


                            <div class="btn btn-warning ms-text-black ">
                            <i class="fa fa-refresh fa-spin fa-fw"></i>
                            Waiting For Admin approval
                          </div>
                          @endif

                @else



                  <div class="btn btn-warning ms-text-black ">
                  <i class="fa fa-refresh fa-spin fa-fw"></i>
                  Waiting For Admin approval
                </div>
           

                @endif




                






              

                @else


                  <div class="btn btn-info ms-text-black ms-mod-btn" ms-live-link="{{ route('ATMS.Task.Rise.Step.View',['TaskId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId'])])  }}" >
                  <i class="fa fa-eye "></i>
                  View Query
                </div>

              <div class="btn btn-danger ms-text-white ms-mod-btn" ms-live-link="{{ route('ATMS.Task.Rise.Step.Replay',['TaskId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId'])])  }}" >
                  <i class="fa fa-reply "></i>
                  Replay to Query
                </div>

                @endif
               </div>



               @else

                 No Document Uploaded

                @endif

               @endif 


                </td>

                <td> {{ \Carbon::parse($step['created_at'])->format('d/m/Y') }}  </td>


              </tr>



              @endforeach

              </table>
                    


                </div>

                <div class="panel-footer">
                  

                     <div class="btn-group btn-group-justified" >
                              
                      <?php 
                
                      $link="ATMS.Task.Upload.Id";
                   
                 

                      ?>  


                  
                        <div class="btn btn-info ms-text-black ms-mod-btn " ms-live-link="{{ route('ATMS.index.Data') }}"><i class="fa fa-fast-backward"  ></i> Go Back to Task List</div>
                        
                        @if($data['task']['Status']!=1)

                         <div class="btn ms-text-black ms-mod-btn btn-success" ms-live-link="{{ route($link,['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ] ) }}"><i class="fa fa-cloud-upload"  ></i> Upload Documents</div>

                                       @endif

                            </div>

                </div>
                </div>