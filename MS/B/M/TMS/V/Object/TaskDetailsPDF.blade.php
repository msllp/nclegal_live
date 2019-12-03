<center>Computer Verified Document by MS-Custom Cloud Application<br>Generated on: {{ \Carbon::now()->format('l jS \\of F Y h:i:s a') }}<br></center>
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


               

                  </td>

              </tr>




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
        if($c->count() > 1){
          $Invoice['UnPaidTotalPartial']=collect($Invoice['UnPaid'])->sum('TotalPaid');  
          $Invoice['UnPaidTotal']=$Invoice['UnPaidTotal']-$Invoice['UnPaidTotalPartial'];
        }
        

      }

if(array_key_exists('Paid', $Invoice)){

  $Invoice['PaidTotal']=collect($Invoice['Paid'])->sum('Total');}
if(array_key_exists('UnPaidTotalPartial', $Invoice))$Invoice['PaidTotal']=$Invoice['PaidTotal']+$Invoice['UnPaidTotalPartial'];
// dd($Invoice );  

     }
     
     ?>


<tr >
  

  <td colspan="1" class=""> 
@if(array_key_exists('UnPaidTotal',$Invoice))
 


 <table class="table table-bordered">

<tr class="">
<td  colspan="">  Total Due Payments </td>
<td  colspan="" class="danger"> <strong> Rs. {{  \MS\Core\Helper\Comman::toINR($Invoice['UnPaidTotal']) }}</strong>  </td>
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

         <td> <span class="text-danger"  title="Current Due Amount"> Rs. {{ \MS\Core\Helper\Comman::toINR($inv['Total']-$inv['TotalPaid']) }}</span>

          <br>
          <small class="text-info" title="Total Invoice Amount" >( Rs. {{ \MS\Core\Helper\Comman::toINR($inv['Total']) }}</small> -  <small class="text-info" title="Total Paid Amount" >Rs. {{ \MS\Core\Helper\Comman::toINR($inv['TotalPaid']) }} )</small>

          
          </td>

        @else

 
        <td>Rs. {{ \MS\Core\Helper\Comman::toINR($inv['Total']) }}</td>


        @endif


        

    </tr>

   @endforeach


 </table>


@else
No Due Payments.
@endif




  

   </td>
  <td colspan="1" > 

@if(array_key_exists('PaidTotal',$Invoice))
 

 <table class="table table-bordered">


<tr class="">
<td  colspan="">  Total Payments </td>
<td  colspan="" class="success"> <strong>Rs. {{  \MS\Core\Helper\Comman::toINR($Invoice['PaidTotal']) }}</strong>  </td>
</tr>
  <tr class="ms-table-heading-tr">
    
    
      
      <th>Invoice No.</th>
      <th>Amount</th>

  </tr>
   
   @foreach($Invoice['Paid'] as $inv)

   <tr class="ms-mod-btn" ms-live-link="{{ route('IM.InvoiceDetails.By.Id',[
   'AgencyCode'=>\MS\Core\Helper\Comman::en4url($data['task']['HireAgencyCode']),
   'InvoiceCode'=>\MS\Core\Helper\Comman::en4url($inv['UniqId'])

   ]) }}">
        
        <td>{{ $inv['MasterInvoiceId'] }}</td>
         <td>Rs. {{ \MS\Core\Helper\Comman::toINR($inv['Total']) }}</td>

    </tr>

   @endforeach


 </table>


@else
No Payment Done Yet.
@endif



  

   </td>



</tr>



@endif



                                 	


                        </table>


             
              <table class="table table-bordered text-capitalize">
                <tr>
                  <td colspan="6" class=""> <h4 style="font-weight: bold;">  Task Current Overview</h4></td>
                </tr>
                <tr class="ms-table-heading-tr">
              <th> No. </th>
              <th> Type of Action</th>
              <th> Action Taken by </th>
              <th>Documents</th>
             
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
                 
                Total Amount: Rs. {{ $docPath['AmountOfDocument'] }}
               </td> 

                @endif
               </tr>
                
                 @endforeach
               
               </table>
              








                 @else

                 No Document Uploaded

                @endif
                </td>



                <td> {{ \Carbon::parse($step['created_at'])->format('d/m/Y') }}  </td>


              </tr>



              @endforeach


             </table>
                    



                </div>

               
                </div>

                <center><br>Computer Verified Document by MS-Custom Cloud Application<br>Generated on: {{ \Carbon::now()->format('l jS \\of F Y h:i:s a') }}</center>