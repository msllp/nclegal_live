<?php $contenClass="col-lg-10"; ?>

@if(!session()->has('agent'))
<div class="col-lg-2" style="padding-left: 0px; padding-right: 2px;">		
@include("AAMS.V.Object.side")
</div>

@else
<?php $contenClass="col-lg-12"; ?>


@endif
<div class="{{ $contenClass}}" style="padding-right: 0px;padding-left: 2px;">
<div class="ms-mod-tab">
@include("AAMS.V.Object.MasterDetails",['data'=>$data])

@if(session()->has('agent'))
<script type="text/javascript">

//Android.showToast("Agent Login Page");
  <?php


  $agent=session('agent');
  //dd($agent);
   ?>


//Android.setUser("{{$agent["AgencyCode"]}}","{{$agent["AgentCode"]}}","{{$agent["ApiToken"]}}");

</script>

@endif

</div>
</div>

