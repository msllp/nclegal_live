<style type="text/css">
	


	/* The location pointed to by the popup tip. */
      .popup-tip-anchor {
        height: 0;
        position: absolute;
        /* The max width of the info window. */
        width: 200px;
      }
      /* The bubble is anchored above the tip. */
      .popup-bubble-anchor {
        position: absolute;
        width: 100%;
        bottom: /* TIP_HEIGHT= */ 8px;
        left: 0;
      }
      /* Draw the tip. */
      .popup-bubble-anchor::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        /* Center the tip horizontally. */
        transform: translate(-50%, 0);
        /* The tip is a https://css-tricks.com/snippets/css/css-triangle/ */
        width: 0;
        height: 0;
        /* The tip is 8px high, and 12px wide. */
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: /* TIP_HEIGHT= */ 8px solid white;
      }
      /* The popup bubble itself. */
      .popup-bubble-content {
        position: absolute;
        top: 0;
        left: 0;
        transform: translate(-50%, -100%);
        /* Style the info window. */
        background-color: white;
        padding: 5px;
        border-radius: 5px;
        font-family: sans-serif;
        overflow-y: auto;
        max-height: 60px;
        box-shadow: 0px 2px 10px 1px rgba(0,0,0,0.5);
      }
    </style>


<div class="panel panel-default" style=" min-height:85vh; ">
	
<div class="panel-heading"><h5><strong> <i class="glyphicon glyphicon-home"></i> Dashboard</strong></h5></div>
<div class="panel-body" style="margin-top: -8px;">


<div class="panel-body" style ="padding:0px;">


<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 ms-live-btn " style="padding-top: 10px;" ms-live-link="{{ action('\B\TMS\Controller@index')  }}">
  <div class="panel panel-default btn-default" >
    <div class="panel-body bg-info">
      <center><img src="{{ asset('/images/responsive.svg') }}" style="max-height: 30px;"></center>
      <h4 class="text-center"> <small> Total Open Task : </small> {{ \B\TMS\Logics::getTotalTask() }}</h4>
    </div>
  </div>

</div>

<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 ms-live-btn " style="padding-top: 10px;"  ms-live-link="{{ action('\B\AMS\Controller@index')  }}">
  <div class="panel panel-default  btn-default" >
    <div class="panel-body bg-success">
      <center>
        <img src="{{ asset('/images/company2.svg') }}" style="max-height: 30px;"></center>
      <h4 class="text-center"><small>Active Agency :</small> {{ \B\AMS\Logics::getTotalAgency() }} </h4>
    </div>
  </div>

</div>

<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  ms-mod-btn "  ms-live-link="{{ route('NMS.index.Data') }}" style="padding-top: 10px;">
  <div class="panel panel-default  btn-default" >
    <div class="panel-body bg-danger">
      <center>
        <img src="{{ asset('/images/mail.svg') }}" style="max-height: 30px;"></center>
      <h4 class="text-center"><small>Unread Notification: </small>{{ \B\NMS\Logics::getTotalUnreadNotification(session('user.userData.UniqId')) }} </h4>
    </div>
  </div>

</div>



</div>




<div class="col-lg-6" style ="padding:0px;padding-right: 5px;">
	<h4 class="text-center  ms-table-heading-tr" style="padding: 8px 0px;"><i class="fa fa-recycle" aria-hidden="true"></i> Recent Tasks</h4>
@include('TMS.V.Object.TaskListWidget')

</div>

<div class="col-lg-6 " style ="padding:0px;">
<h4 class="text-center  ms-table-heading-tr" style="padding: 8px 0px;"><i class="fa fa-building" aria-hidden="true"></i> Agency Master

   </h4>
@include('AMS.V.Object.AgencyWidget')

</div>



</div>

</div>


</div>

