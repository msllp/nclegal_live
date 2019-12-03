            <ul class="nav navbar-nav pull-right">
 


   <li class="visible-md visible-lg" role="presentation"><div class="loading ">
   	
   	<img src="{{asset('/images/loading.gif')}}" width="40px" height="40px"> 
   </div> </li>


<?php 

   $user=session('user')['userData'];

  \MS\Core\Helper\Comman::DB_flush();
  // dd(session()->all()  );
  //$r=new Illuminate\Http\Request();
  //dd(Session::get('user'));  
  $m1=new \B\ANMS\Model(1,(string)session('user.userData.UniqId'));
  //dd($m1);

  $n=$m1->where('Read',0)->get()->forPage(1, 3);
  \MS\Core\Helper\Comman::DB_flush();

  $btnColor='';

  if (count($n) > 0) {

    $btnColor='bg-success';
    # code...
  }
   ?>



  <li class="ms-border ms-mod-btn {{ $btnColor }}"  ms-live-link="{{ route('ANMS.index.Data') }}"   > 
<a >
 <i class="fa fa-bell-o" ></i>

</a>

</li>

  <li class="ms-border dropdown ms-notification-btn {{ $btnColor }}" ms-channel="{{ \MS\Core\Helper\Notify::$channels['agency']['app_name'] }}"  ms-channel-key="{{ \MS\Core\Helper\Notify::$channels['agency']['key'] }}" ms-live-link="{{ route('ANMS.Notification.By.User',['UserId'=>\MS\Core\Helper\Comman::en4url(session('user.userData.UniqId'))]) }}"   > 
<a href="" class="dropdown-toggle" id="notificationLable" role="presentation" data-toggle="dropdown"  aria-haspopup="true">
<i class="fa fa-caret-down" aria-hidden="true"></i>
</a>


<ul class="dropdown-menu" id="notificationBox" aria-labelledby="notificationLable">

    
@include('ANMS.V.Object.NotificationBox')
<li  style="padding:5px;" class="ms-mod-btn list-group-item-info text-right ms-text-bold" ms-live-link="{{ route('ANMS.index.Data') }}">View All <i class="fa fa-caret-down" aria-hidden="true"></i></li>


</ul>


  <li class="bg-info ms-border" role="presentation" data-toggle="modal" data-target="#profileModal" > <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{$user['name']}} </a>



  </li>

  @if(session()->has('user.adminData'))
    
  <li class="bg-danger ms-border" role="presentation"><a href="{{route('AMS.Agency.BackAsAdmin')}}" ms-live-link="{{route('AMS.Agency.BackAsAdmin')}}" ms-shortcut="q"><i class="fa fa-sign-out" aria-hidden="true"></i> Back to Admin Panel</a></li>   

  @else
  <li class="bg-danger ms-border" role="presentation"><a href="{{route('APanel.Logout')}}" ms-live-link="{{route('APanel.Logout')}}" ms-shortcut="q"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a></li>
  @endif
</ul>