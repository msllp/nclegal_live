<?php // dd($data['task']['Status']);
  
  $color="info";
  if($data['task']['Status'])$color='danger';
  \B\IM\F\Invoice::checkLedgerOrMakeLeder($data['task']['HireAgencyCode']);
 ?>

<div class="panel panel-{{$color}}" >
      <?php 
    //  dd($data);
      $userRole=0;
              if(session('user.SuperAdmin')){
                      $userRole=1;
                      }elseif (session('user.AgencyAdmin')) {
                      $userRole=2;
                      }else{
                      $userRole=0;
                      }

                     
                      ?>
                    
                        <div class="panel-heading text-capitalize"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Task No. {{  $data['task']['UniqId'] }}
                        

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

               
                
                <th>Assined Agency  </th>
                <td>: {{\B\AMS\Logics::getAgencyName($data['task']['HireAgencyCode'])}}

                  

                <div class="btn btn-info ms-text-black ms-mod-btn pull-right  hidden-print" ms-live-link="{{ route('AMS.Agency.LoginAsAdmin.Id',['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['HireAgencyCode'])]) }}"> Login as Agency <i class="fa fa-sign-in"  ></i></div>

                </td>

               
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

@if($data['task']['Status'] == 1 )
         


                 <tr>
                
                <th>Status </th>
                <td>: {{ \B\TMS\Logics::getCurrentStatus ($data['task']['CurrentStatus'])}} </td>

              
              </tr> 
<!-- 
              <tr class="hidden-print">
                
                <th colspan="2" >
                  
                  <?php 
                      \MS\Core\Helper\Comman::DB_flush();



    $id=10;
    $build=new \MS\Core\Helper\Builder ("B\TMS");
    $m=new \B\TMS\Model($id);

    //
    $build->title("Task Overview")->heading(['Basic Details of APR']);

    if($m->where('TaskId',$data['task']['UniqId'])->get()->count() > 0)
      {

        $m=$m->where('TaskId',$data['task']['UniqId'])->get()->first();
      //  dd($m->toArray());
         $build->content($id,$m->toArray());

      }else{

        $build->content($id);
      }


   $build ->action("taskAddPost")
              // ->btn([
              //   //'action'=>"\\B\\MAS\\Controller@addCCPost",
              //   'color'=>"btn-success",
              //   'icon'=>"fa fa-floppy-o",
              //   'text'=>"Save"
              // ])
          
   ;
    // $build->title("Add Agency")->heading(['Basic Details of Agency'])->content($id)->action("agencyAdd")->btn([
    //            'action'=>"\\B\\AMS\\Controller@indexData",
    //            'color'=>"btn-info",
    //            'icon'=>"fa fa-fast-backward",
    //            'text'=>"Back"
    //          ])->heading(['Conern Person Details'])->extraFrom('2')->heading(['Login Details For Agency'])->extraFrom('3')->btn([
    //            //'action'=>"\\B\\MAS\\Controller@addCCPost",
    //            'color'=>"btn-success",
    //            'icon'=>"fa fa-floppy-o",
    //            'text'=>"Save"
    //          ]);
  \MS\Core\Helper\Comman::DB_flush();

    echo $build->view()->render();

                  ?>

                </th>

              </tr> -->



          <?php

                                          \MS\Core\Helper\Comman::DB_flush();

$count=0;
  \MS\Core\Helper\Comman::DB_flush();
  if(array_key_exists('Data',\B\IM\Logics::getInvoiceByTaskId($data['task']['UniqId'])))
{$count=\B\IM\Logics::getInvoiceByTaskId($data['task']['UniqId'])['Data'];
$count=collect($count)->where('HasMasterInvoiceNo','0')->count();

}

                     ?>

                     @if($count > 0)
              <tr class="hidden-print">
                  <td colspan="2">

          

                    <div class="btn-group btn-group-justified">

                       <div class="btn btn-info ms-mod-btn " ms-live-link="{{ route('TMS.Task.Genrate.Payment',['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId'])]) }}" >
                        <i class="fa fa-sticky-note-o"></i>
                        Generate Invoice
                      </div>                     

                    </div>
<!-- include('B.L.Object.MS.Model', ['data'=>[
  
  'header'=>"Add Payment",
  'body'=>$build->view()->render(),
  'footer'=>" "

]]) -->
                  </td>

              </tr>
              @else

              <tr class="success text-center">
                  
                  <td colspan="2"> <strong> <i class="fa fa-smile-o" aria-hidden="true"></i> Good,All Invoices Generated for all bills.</strong></td>

              </tr>


@endif

                <?php 
   \MS\Core\Helper\Comman::DB_flush();
    $m1=new \B\IM\Model(\B\IM\F\Invoice::$lederTableId,$data['task']['HireAgencyCode']);
    //dd($m1);
    $Invoice=[];
    $m11=$m1->where('TaskId',$data['task']['UniqId'])->get();

     if($m11->count() > 0 ){

        $m111=$m1->where('TaskId',$data['task']['UniqId'])->where('Paid','0')->get();
        $m112=$m1->where('TaskId',$data['task']['UniqId'])->where('Paid','1')->where('PartiallyPaid',0)->get();



      if($m111->count() > 0){

       $Invoice['UnPaid']=$m111->toArray();

      }
      if($m112->count() > 0){

       $Invoice['Paid']=$m112->toArray();

      }
    
      if(array_key_exists('UnPaid', $Invoice)){

        $c=collect($Invoice['UnPaid']);
        $Invoice['UnPaidTotal']=$c->sum('Total');
        $c1=$c->where('PartiallyPaid',0);
        if($c->count() > 0){
          $Invoice['UnPaidTotalPartial']=collect($Invoice['UnPaid'])->sum('TotalPaid');  
          $Invoice['UnPaidTotal']=$Invoice['UnPaidTotal']-$Invoice['UnPaidTotalPartial'];
        }
        

      }
//dd($Invoice);
if(array_key_exists('Paid', $Invoice)){

  $Invoice['PaidTotal']=collect($Invoice['Paid'])->sum('Total');

  if(array_key_exists('UnPaidTotalPartial', $Invoice))$Invoice['PaidTotal']=$Invoice['PaidTotal']+$Invoice['UnPaidTotalPartial'];
}

//dd($Invoice );  

     }


     
     ?>


<tr >
  

  <td colspan="1" class=""> 
@if(array_key_exists('UnPaidTotal',$Invoice))
 


 <table class="table table-bordered">

<tr class="">
<td  colspan="">  Total Due Payments </td>
<td  colspan="" class="danger"> <strong> ₹ {{  \MS\Core\Helper\Comman::toINR($Invoice['UnPaidTotal']) }}</strong>  </td>
</tr>
  <tr class="ms-table-heading-tr">
    
    
      
      <th>Invoice No.</th>
      <th>Amount</th>

  </tr>
   
   @foreach($Invoice['UnPaid'] as $inv)

   <tr class="ms-mod-btn" ms-live-link="{{ route('IM.InvoiceDetails.By.Id',[
   'AgencyCode'=>\MS\Core\Helper\Comman::en4url($data['task']['HireAgencyCode']),
   'InvoiceCode'=>\MS\Core\Helper\Comman::en4url($inv['UniqId'])

   ]) }}">
        
        <td>{{ $inv['MasterInvoiceId'] }}</td>
        <?php 

       // var_dump($inv['PartiallyPaid']);
        // if($inv['PartiallyPaid'] == 1){
        //   $inv['Total']=$inv['Total']-$inv['TotalPaid'];
        // }

        ?>

        @if($inv['PartiallyPaid'] == 1)

         <td> <span class="text-danger"  title="Current Due Amount"> ₹ {{ \MS\Core\Helper\Comman::toINR($inv['Total']-$inv['TotalPaid']) }}</span>

          <br>
          <small class="text-info" title="Total Invoice Amount" >( ₹ {{ \MS\Core\Helper\Comman::toINR($inv['Total']) }}</small> -  <small class="text-info" title="Total Paid Amount" >₹ {{ \MS\Core\Helper\Comman::toINR($inv['TotalPaid']) }} )</small>

          
          </td>

        @else

 
        <td>₹ {{ \MS\Core\Helper\Comman::toINR($inv['Total']) }}</td>


        @endif


        

    </tr>

   @endforeach


 </table>


@else
No Due Payments.
@endif




  

   </td>
  <td colspan="1" > 

@if(array_key_exists('Paid',$Invoice) or array_key_exists('UnPaidTotalPartial',$Invoice) )

<?php
    
    if(!array_key_exists('Paid', $Invoice)){
    if(!array_key_exists('PaidTotal', $Invoice)){
      //dd($Invoice);
      if(array_key_exists('UnPaidTotalPartial', $Invoice) && ($Invoice['UnPaidTotalPartial'] > 0 )  )
      {$Invoice['PaidTotal']=$Invoice['UnPaidTotalPartial'];
      }
    else{
       $Invoice['PaidTotal']=0;

    }

    }

  }



?>
@if($Invoice['PaidTotal'] > 0)

 <table class="table table-bordered">


<tr class="">
<td  colspan="2">  Total Payments </td>
<td  colspan="" class="success"> <strong>₹ {{  \MS\Core\Helper\Comman::toINR($Invoice['PaidTotal']) }}</strong>  </td>
</tr>

 @if(array_key_exists('Paid',$Invoice))
  <tr class="ms-table-heading-tr">
    
    
      
      <th>Invoice No.</th>
      <th>Date of Payment</th>
      <th>Amount</th>
      

  </tr>
   

   @foreach($Invoice['Paid'] as $inv)

   <tr class="ms-mod-btn" ms-live-link="{{ route('IM.InvoiceDetails.By.Id',[
   'AgencyCode'=>\MS\Core\Helper\Comman::en4url($data['task']['HireAgencyCode']),
   'InvoiceCode'=>\MS\Core\Helper\Comman::en4url($inv['UniqId'])

   ]) }}">
        
        <td>{{ $inv['MasterInvoiceId'] }}</td>
           <td>
            @if($inv['DateOfPaymentToAgency'] > 0)
            {{ \Carbon::parse($inv['DateOfPaymentToAgency'])->format('d/m/Y') }}
            @else
            Opps,No Date Of Payment Found !
            @endif
          </td>
         <td>₹ {{ \MS\Core\Helper\Comman::toINR($inv['Total']) }}</td>
        

    </tr>

   @endforeach

   @endif
 </table>


@else
No Payment Done Yet.
@endif


@else
No Payment Done Yet.
@endif



  

   </td>



</tr>



@endif



                                 	


                        </table>


             
              <table class="table table-bordered text-capitalize">
                <tr>
                  <td colspan="6" class=""> <img src="{{ asset('/images/responsive.svg') }}" class="col-lg-1 hidden-print" style="max-height: 30px;"><h4 style="font-weight: bold;">  Task Current Overview</h4></td>
                </tr>
                <tr class="ms-table-heading-tr">
              <th> No. </th>
              <th> Type of Action</th>
              <th> Action Taken by </th>
              <th>Documents</th>
              <th class=" hidden-print">Action</th>
              <th> Date </th>
              </tr>
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
                
                $documentArray=(array)json_decode($step['DocumentArray'],true);
                $documenyArrayVeri=(array)json_decode($step['DocumentVerifiedArray'],true);
                 $documenyArrayRej=(array)json_decode($step['DocumentRejectedArray'],true);
                $documenyArrayquery=(array)json_decode($step['DocumentVerifiedArray'],true);
                
                $DocumentQuery=$step['DocumentQuery'];
                $DocumentQueryReplay=$step['DocumentReply'];


                 ?>


   
              <table class="table table-bordered text-capitalize">

                
                 @foreach($documentArray as $docName=>$docPath )
                 
                 <tr>
                  <?php
                  $docPath=(array)$docPath;

                  $url=str_replace('\\' ,'/',$docPath['path']);
                  $urlArray=explode('/',$url);
                  $c=\MS\Core\Helper\Comman::random(2);
                  array_splice($urlArray, 1, 0, $c);
                  $url=implode('/', $urlArray);
                 // dd($docPath);  

                 //;
                 // if('Panchnma Copy_452'==explode('.',$docName)[0])dd($docPath);
                   ?>
                  
                  
                  <td>
                      <a class="btn btn-default  visible-print-block" href="{{ explode('.',$docName)[0] }}" target="_BLANK"><i class="fa fa-paperclip" style="padding-right:5px;" aria-hidden="true"></i></a>

<a class="btn btn-default  hidden-print" href="{{ route('TMS.Task.Get.File.Name',['UniqId'=>\MS\Core\Helper\Comman::en4url($c),'TaskId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']),'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId']),'TypeOfDocument'=>\MS\Core\Helper\Comman::en4url($docPath['TypeOfDocument']),'FileName'=>$docName]) }}" target="_BLANK">


                 

                 <i class="fa fa-paperclip" style="padding-right:5px;" aria-hidden="true"></i> {{ explode('.',$docName)[0] }}
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


                <td class=" hidden-print">
                  

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

                  <div class="btn btn-info ms-text-black ms-mod-btn" ms-live-link="{{  route('TMS.Task.Rise.Step.Query.View',['TaskId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ,'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId']) ] ) }}">
                  <i class="fa fa-eye"></i>
                  View Records
                </div>

                  </div>

               @else

                     <?php  //dd($step) 

                $step['DocumentQueryArray']=json_decode($step['DocumentQueryArray'],true);
                $step['DocumentArray']=json_decode($step['DocumentArray'],true);
                $step['DocumentVerifiedArray']=json_decode($step['DocumentVerifiedArray'],true);
                 ?>

                  <div class="btn-group btn-group-xs">
               @if($step['DocumentUploaded'])



             

               @if(!$DocumentQuery)
                 

                                <div class="btn btn-info ms-text-black ms-mod-btn" ms-live-link="{{  route('TMS.Task.Approve.Id',['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ,'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId']) ] ) }}">
                                  <i class="fa fa-check"></i>
                                  Approve
                                </div>

                               @if(!$DocumentQueryReplay)

                               
                                <div class="btn btn-danger ms-text-white ms-mod-btn" ms-live-link="{{  route('TMS.Task.Rise.Step.Query',['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ,'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId']) ] ) }}">
                                  <i class="fa fa-question"></i>
                                  Rise Query
                                </div>


                                @else




                                 @if( count($documenyArrayquery) != count($documentArray) )

                                  <div class="btn btn-danger ms-text-white ms-mod-btn" ms-live-link="{{  route('TMS.Task.Rise.Step.Query',['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ,'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId']) ] ) }}">
                                  <i class="fa fa-question"></i>
                     
                                  Rise Query
                                  </div>
                                                           

                                 @endif

                               

                                <div class="btn btn-warning ms-text-black ms-mod-btn" ms-live-link="{{  route('TMS.Task.Rise.Step.Query.View',['TaskId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ,'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId']) ] ) }}">
                                  <i class="fa fa-eye"></i>
                                  View Replay
                                </div>
                                 @endif

                @else


          

                   @if((count($step['DocumentQueryArray']) != count($step['DocumentArray'])) && (count($step['DocumentVerifiedArray']) < count($step['DocumentArray'])))
                  
                    <div class="btn btn-danger ms-text-white ms-mod-btn" ms-live-link="{{  route('TMS.Task.Rise.Step.Query',['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ,'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId']) ] ) }}">
                    <i class="fa fa-question"></i>
                    Rise Query
                  </div>
                   @endif

                   <div class="btn btn-info ms-text-black ms-mod-btn" ms-live-link="{{  route('TMS.Task.Rise.Step.Query.View',['TaskId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ,'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId']) ] ) }}">
                  <i class="fa fa-eye"></i>
                  View Query
                </div>
                <div class="btn btn-warning ms-text-black" >
                  <i class="fa fa-refresh fa-spin fa-fw"></i>
                  Waiting For Agency Replay
                </div>

                @endif

            
            
               </div>



               @else

                 No Document Uploaded

                @endif

               @endif 
              @if($data['task']['Status'] == 0)
               @if(session()->get('user.userData.UniqId')==$step['TakenBy'])


               @if($step['TypeOfAction'] !='0')
      

                 <div class="btn btn-danger btn-xs ms-text-black ms-mod-btn" ms-live-link="{{  route('TMS.Task.Step.Delete.Id',['TaskId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ,'StepId'=>\MS\Core\Helper\Comman::en4url($step['UniqId']) ]) }}" >
                  <i class="fa fa-trash "></i>
               
                </div>
                @endif
                @endif
                @endif


                </td>

                <td> {{ \Carbon::parse($step['created_at'])->format('d/m/Y') }}  </td>


              </tr>



              @endforeach


             
              
              <table class="table table-bordered text-capitalize hidden-print">
              
              <tr>
                  <td colspan="4" class=""> <img src="{{ asset('/images/detective.svg') }}" class="col-lg-1 " style="max-height: 30px;"><h4 style="font-weight: bold;">  Agent List</h4></td>
                </tr>
              <tr class="ms-table-heading-tr">
                
                <th>Agent Code</th>
                <th>Agent Name</th>
                <th>Contact No.</th>
                <th>Email</th>

              </tr>

                <?php 

               // dd($data);
                $m=new \B\AAMS\Model(1,$data['task']['HireAgencyCode']);
                  
                
                if($m->where('AgentCurrentTask',$data['task']['UniqId'])->get()->count() > 0){

                  $agents=$m->where('AgentCurrentTask',$data['task']['UniqId'])->get()->toArray();

                }else{
                  $agents=[];
                }

              //  dd($agents);
                ?>

                @if(count($agents) > 0)


                @foreach($agents as $value)
                <tr>
                
                <td>{{ $value['AgentCode'] }}</td>
                <td>{{ $value['AgentName'] }}</td>
                <td>{{ $value['AgentContactNo'] }}</td>
                <td>{{ $value['AgentEmail'] }}</td>

                </tr>
                @endforeach


                @else

                <tr class="text-center warning">
                  
                  <td colspan="4">No Agent working on this Task </td>
                </tr>
                @endif

              </table>

              </table>
                    



                </div>

                <div class="panel-footer  hidden-print">
                  

                     <div class="btn-group btn-group-justified" >
                              
                      <?php 
                   //   dd(session()->all());
                      if(session('user.SuperAdmin')){
                      $link="TMS.Task.View";
                      }elseif (session('user.AgencyAdmin')) {
                      $link="ATMS.Task.Upload.Id";
                      }else{
                      $link=null;
                      }

                 

                      ?>  


                        @if($userRole==1)

                              <div class="btn btn-default ms-text-black ms-mod-btn" ms-shortcut="back" ms-live-link="{{ route($link) }}"><i class="fa fa-fast-backward"  ></i><br> Go Back</div>
                                  
                                  @if(!$data['task']['Status'] == 1)
                                   <div class="btn btn-warning ms-text-black ms-mod-btn" ms-live-link="{{route('TMS.Task.Rise.Query',['TaskId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId'])])}}"><i class="fa fa-question"  ></i><br> Rise Query</div>
                                  @endif
    <div class="btn ms-text-black ms-mod-btn btn-success" ms-live-link="{{ route('TMS.Task.Upload.Id', ['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ] ) }}"><i class="fa fa-cloud-upload"  ></i> Upload Documents</div>

   
  <a class="btn btn-info"  target="_blank" href="{{ route('TMS.Task.View.Id.PDF', 

                         ['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ] ) }}"><i class=" fa fa-repeat " > </i> Report  </a>



    <?php // dd($data['task']['Status']);
  
              $color="danger";
              $btnIcon="fa fa-times";
              $text="Close Task";
              $textColor="white";

              if($data['task']['Status'] == 1){

                $color='default';
                $btnIcon="fa fa-refresh";
                $text="Refresh Task";
                  $textColor="black";



              }

             ?>

                           <div class="btn ms-mod-btn btn-{{$color}}  ms-text-{{$textColor}} " ms-live-link="{{ route('TMS.Task.Close.Id', 

                         ['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ] ) }}"><i class=" {{$btnIcon}} "  ></i> {{  $text }}</div>




                        @elseif($userRole==2)

                        <div class="btn btn-info ms-text-black ms-mod-btn " ms-shortcut="back" ms-live-link="{{ route('ATMS.index.Data') }}"><i class="fa fa-fast-backward"  ></i> Go Back</div>
                         <div class="btn ms-text-black ms-mod-btn btn-success" ms-live-link="{{ route($link, 

                         ['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ] ) }}"><i class="fa fa-cloud-upload"  ></i> Upload Documents</div>



                          <?php // dd($data['task']['Status']);
  
  $color="danger";
  $btnIcon="fa fa-times";
  $text="Close Task";

  if($data['task']['Status'] == 1){

    $color='success';
    $btnicon="fa fa-refresh";
    $text="Refresh Task";



  }

 ?>

                           <div class="btn ms-mod-btn btn-{{$color}} ms-text-{{$textColor}}" ms-live-link="{{ route('TMS.Task.Close.Id', 

                         ['UniqId'=>\MS\Core\Helper\Comman::en4url($data['task']['UniqId']) ] ) }}"><i class=" {{$btnIcon}} "  ></i> {{  $text }}</div>

                        @endif                           

                            </div>

                </div>
                </div>