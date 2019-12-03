





            <ul class="nav navbar-nav pull-right">
 


   <li class="visible-md visible-lg" role="presentation"><div class="loading ">
   	
   	<img src="{{asset('/images/loading.gif')}}" width="40px" height="40px"> 
   </div> </li>



   	<?php 

//dd();
$name=session('agent.AgentData.AgentName');
$code=session('agent.AgentData.AgentCode');



?>



	<li class="bg-info ms-border"role="presentation"><a  >ID: {{$code}} </a></li>
   <li class="bg-info ms-border"role="presentation"><a  >{{$name}} </a></li>

  <li class="bg-danger ms-border" role="presentation"><a href="{{route('AAMS.Agent.Logout')}}" ms-live-link="{{route('AAMS.Agent.Logout')}}" ms-shortcut="q"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a></li>

</ul>