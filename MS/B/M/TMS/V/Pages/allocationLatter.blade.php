
<div class="panel panel-info" >



<div class="panel-body">
<p>Dear {{ $data['agency']['name'] }},</p>
 
<textarea class="col-lg-12" rows="2">Our client, Star India Private Limited, informs us that a Cable Operator M/s.{{ $data['task']['NameOperator'] }}, has been unauthorizedly and illegally transmitting/broadcasting Star
Channels through {{ $data['task']['ModePiracy'] }} of {{ $data['task']['NameOfNetwork']}} in To Be Added.
  </textarea>
                      

   <table class="table table-bordered"> 
   <tr>
   	<th colspan="2">The particulars of the Cable Operator are as below:</th>

   </tr>
 	<tr>
<th>Name of Operator </th> <td>: M/s. {{ $data['task']['NameOperator'] }}</td>
</tr>
 	<tr>
<th>Name of Owners/Partners </th> <td>: {{ $data['task']['NameOwner'] }}</td>
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
              
              </tr>    	<tr>
<th>Illegal broadcasting </th> <td>: {{ $data['task']['IllegalTypeBroadcasting'] }}</td>
</tr>
 	<tr>
<th>Status of Operator </th> <td>: {{ $data['task']['StatusOperator'] }} </td>
</tr>
 	<tr>
<th>Mode of Piracy </th> <td>: {{ $data['task']['ModePiracy'] }}</td>
</tr> 
</table>

<textarea class="col-lg-12" rows="4">
Please note that in view of the fact that M/s. {{ $data['task']['NameOperator'] }}, is a {{ $data['task']['StatusOperator'] }} of {{ $data['task']['NameOfNetwork']}} broadcasting {{ $data['task']['IllegalTypeBroadcasting'] }} through
{{ $data['task']['ModePiracy'] }} of {{ $data['task']['NameOfNetwork']}} in To Be Added, the broadcasting of Star Pay Channels over its network
in To Be Added, by M/s. {{ $data['task']['NameOperator'] }},is without any authority of law, and not under any agreement with our client.
</textarea>

<textarea class="col-lg-12" rows="4">Our client has received information that the illegal telecast of Star Pay Channels by
M/s. . {{ $data['task']['NameOperator'] }},has been taking place continuously and piracy has been
reported in the areas.
 </textarea>
<textarea class="col-lg-12" rows="4">Our client has desired that we track such illegal transmission of its channels by the Cable
Operator, and take appropriate steps to stop the piracy in accordance with law.
</textarea>
<textarea class="col-lg-12" rows="4">We, accordingly, request you to depute an appropriate team of trained and authorized
</textarea>

<textarea class="col-lg-12" rows="6">If the team finds continued illegal transmission of Star Channels by the Cable Operator, we
request you to kindly have them record the broadcast and send it to us for verification.
Thereafter, we shall, in consultation with our client, send you a draft of complaint to be
filed with the local police and government authority for stopping the illegal transmission of
the Star Channels by the Cable Operator.
</textarea>

<textarea class="col-lg-12" rows="5">We trust that each member of the team will respect the secrecy of the information shared
with you, and also not indulge in any activity which can be termed as illegal or
inappropriate and otherwise not in consonance with the agreement entered into by you
with us.
</textarea>
 
If you need any further information, please feel free to write to us or call us.
 <br>
Thank You and Regards,



</div>

</div>