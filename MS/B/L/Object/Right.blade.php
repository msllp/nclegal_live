            <ul class="nav navbar-nav pull-right">
 


   <li class="visible-md visible-lg" role="presentation"><div class="loading ">
   	
   	<img src="{{asset('/images/loading.gif')}}" width="40px" height="40px"> 
   </div> </li>

	 <?php 

	 $user=session('user')['userData'];

  \MS\Core\Helper\Comman::DB_flush();
  $m1=new \B\NMS\Model(3,(string)session('user.userData.UniqId'));
  //dd($m1->MS_all());
  $n=$m1->where('Read',0)->get()->forPage(1, 3);
  \MS\Core\Helper\Comman::DB_flush();

  $btnColor='';
  $btnIcon="";
  $styleiconPatch="";
  if (count($n) > 0) {

    $btnColor='bg-success';
    $btnIcon='fa-2x animated infinite flash text-danger slow';
    $styleiconPatch="padding:10px;";
    # code...
  }
	 ?>




  <li class="ms-border"    role="presentation" data-toggle="modal" data-target="#shortCutModal"> 
<a class="" style="cursor: pointer;">
 <i class="fa fa-keyboard-o" ></i>



</a>

</li>

  <li class="ms-border ms-mod-btn {{ $btnColor }}"  ms-live-link="{{ route('NMS.index.Data') }}"   > 
<a >
 <i class="fa fa-bell-o" ></i>

</a>

</li>

  <li class="ms-border dropdown ms-notification-btn {{ $btnColor }}" ms-channel="{{ \MS\Core\Helper\Notify::$channels['admin']['app_name'] }}"  ms-channel-key="{{ \MS\Core\Helper\Notify::$channels['admin']['key'] }}" ms-live-link="{{ route('NMS.Notification.By.User',['UserId'=>\MS\Core\Helper\Comman::en4url(session('user.userData.UniqId'))]) }}"   > 
<a  class="dropdown-toggle" style="{{$styleiconPatch}}" id="notificationLable" role="presentation" data-toggle="dropdown"  aria-haspopup="true">
<i class="fa fa-caret-down {{$btnIcon}}" aria-hidden="true"></i>
</a>


<ul class="dropdown-menu" id="notificationBox" aria-labelledby="notificationLable">

    
@include('NMS.V.Object.NotificationBox')
<li  style="padding:5px;" class="ms-mod-btn list-group-item-info text-right ms-text-bold" ms-live-link="{{ route('NMS.index.Data') }}">View All <i class="fa fa-caret-down" aria-hidden="true"></i></li>


</ul>


</li>







  <li class="bg-info ms-border" role="presentation" data-toggle="modal" data-target="#profileModal" > <a href="#"><span class="label label-default">P</span> <i class="fa fa-user-circle-o" aria-hidden="true"></i> {{$user['name']}} </a>




  </li>
  <li class="bg-danger ms-border" role="presentation"><a href="{{action('\B\Users\Controller@logout')}}" ms-live-link="{{action('\B\Users\Controller@logout')}}" ms-shortcut="q"><span class="label label-default">Q</span> <i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a></li>
  
</ul>