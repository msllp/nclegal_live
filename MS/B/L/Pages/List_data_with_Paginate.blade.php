

<?php
$heading=[];
$headingKey=[];


$data['List-Paginate']->setPath('');

if(count($data['List-array'])>0){




  foreach ($data['List-array'] as $key => $value) {
    
    if(in_array($key, $data['List-display'])){

      $heading[]=ucfirst($value);
    $headingKey[]=$key;
    }else{

       $heading[]=ucfirst($value);

    }
    



  }


}else{

  $heading=$data['List-display'];
  $headingKey=$data['List-display'];

}




//dd($heading);

?>
<div class="panel panel-default ">


  @isset($data['List-title'])
 
<div  class="panel-heading panel-info"><h5 class=""> <strong><i class="glyphicon glyphicon-chevron-right"></i> {{$data['List-title']}}



</strong>  
</h5></div>

@endisset
  <div class="panel-body " >

    @if(array_key_exists('List-btn' ,$data) && (count($data) > 0))
  <div class="col-lg-12 ms-task-btn" style="">
    

     <div class="btn-group">
  
        
      @foreach ($data['List-btn'] as $btn)
      
      @if(array_key_exists('action',$btn))

      @if(array_key_exists('data',$btn))
      
      @if(array_key_exists('color',$btn))
      {{ Form::button("<i class='".$btn["icon"]." ' aria-hidden='true'></i> ".$btn["text"], ['class'=>'btn   ms-mod-btn '.$btn['color'].' ms-text-black' , 'ms-live-link'=>action($btn["action"],$btn['data']),] ) }}
      @else
      {{ Form::button("<i class='".$btn["icon"]."' aria-hidden='true'></i> ".$btn["text"], ['class'=>'btn btn-info   ms-mod-btn'.' ms-text-black' , 'ms-live-link'=>action($btn["action"],$btn['data']),] ) }}
      @endif


      @else
      
      @if(array_key_exists('color',$btn))
      {{ Form::button("<i class='".$btn["icon"]."' aria-hidden='true'></i> ".$btn["text"], ['class'=>'btn   ms-mod-btn '.$btn['color'].' ms-text-black' , 'ms-live-link'=>action($btn["action"]),] ) }}
      @else
      {{ Form::button("<i class='".$btn["icon"]."' aria-hidden='true'></i> ".$btn["text"], ['class'=>'btn btn-info   ms-mod-btn ms-text-black ' , 'ms-live-link'=>action($btn["action"]),] ) }}
      @endif


      @endif

      
      @else

      @if(array_key_exists('color',$btn))
      {{ Form::div("<i class='".$btn["icon"]."' aria-hidden='true'></i> ".$btn["text"], ['class'=>'btn  btn-frm-submit end-close '.$btn['color'].' ms-text-black'] ) }}
      @else
      {{ Form::div("<i class='".$btn["icon"]."' aria-hidden='true'></i> ".$btn["text"], ['class'=>'btn btn-success  btn-frm-submit ms-text-black'] ) }}
      @endif
      

      @endif


      @endforeach
      </div>


  </div>

@endif

</div>
      <table class="table table-bordered table-hover table-striped" >
  <tr class="ms-table-heading-tr">
     <th class="text-right" title="alt +  i + { 1,2,.. }" style="cursor:help;"><i class="fa fa-hashtag" aria-hidden="true"></i></th>

  @foreach ($heading as $head)
    <th title="{{ $head }}" style="cursor:no-drop;">{{ $head }}</th>
  @endforeach

      @if(array_key_exists('ms-action-btn',$data['List-action']) or array_key_exists('edit-btn',$data['List-action']) or (array_key_exists('delete-btn',$data['List-action']) or array_key_exists('LoginasAgency-btn',$data['List-action']))   )


 <th>Action</th>

    @endif
  </tr>
<tbody>

<?php


$sortType='sortByDesc';
$sortBy='updated_at';

if (array_key_exists('sortType',(array)  $data['List-extraData'])) {
  

    switch ($data['List-extraData']['sortType']) {
  case 'l2o':
    $sortType='sortBy';
    break;
        case 'sortBy':
            $sortType=$data['List-extraData']['sortType'];
            break;

  default:
    # code...
    break;
}


}

if (array_key_exists('sortBy',(array) $data['List-extraData'])) {

  $sortBy=$data['List-extraData']['sortBy'];
}

//dd(  $data['List-Paginate']->$sortType($sortBy)->toArray());


 ?>

  @foreach ($data['List-Paginate']->$sortType($sortBy) as $object)


    <?php 


  $trColor='';
  $boldtext='';
//dd(session()->all());

  //if(session()->has('user.SuperAdmin'))

if(session()->has('user.SuperAdmin')){

//dd(session('user.AgencyAdmin'));
if(session('user.SuperAdmin') && !(session('user.AgencyAdmin')!=null || session('user.AgencyAdmin')!=0) ){

  if($object->ReadStatus!=null){

    if($object->ReadStatus==0){

        $trColor=' ';


        if($object->ReadUserCode!=null){

          $object->ReadUserCode=json_decode($object->ReadUserCode,true,3);

       // dd($object->ReadUserCode);

          if(!in_array(session('user.userData.UniqId'), $object->ReadUserCode)){
             $trColor='info';
            $boldtext='ms-text-bold';

          }


        }

    }




  

  }


}


}


  if($object->Read!=null){

    if($object->Read==0){

            $boldtext='ms-text-bold';


        }

    }




  

  





   ?>



   @if(array_key_exists('view-btn',$data['List-action']))
  
 

  @if($loop->iteration < 10)


  <tr style="cursor:pointer; "  class="ms-mod-btn {{$trColor}} {{$boldtext}}" ms-live-link="{{ route($data['List-action']['view-btn']['method'],\MS\Core\Helper\Comman::en4url($object->$data['List-action']['view-btn']['key'])) }}"      ms-shortcut="i+{{$loop->iteration }}" > 
  
    @elseif($loop->iteration == 10)

  <tr style="cursor:pointer; " class="ms-mod-btn {{$trColor}} {{$boldtext}}" ms-live-link="{{ route($data['List-action']['view-btn']['method'],\MS\Core\Helper\Comman::en4url($object->$data['List-action']['view-btn']['key'])) }}"      ms-shortcut="i+0" > 
  

    @else
  <tr style="cursor:pointer; " class="ms-mod-btn {{$trColor}} {{$boldtext}} " ms-live-link="{{ route($data['List-action']['view-btn']['method'],\MS\Core\Helper\Comman::en4url($object->$data['List-action']['view-btn']['key'])) }}"     > 

    @endif
   @else
   </tr>

  @endif

@if($loop->iteration < 10 )
<td class="text-right" title="Shortcut : Alt + i + {{$loop->iteration}}" style="cursor: wait;">{{$loop-> iteration}}</td>
 
@elseif($loop->iteration == 10)
 <td class="text-right" title="Shortcut : Alt + i + 0" style="cursor: wait;">{{$loop->iteration}}</td>

@else

 <td class="text-right" style="cursor: not-allowed;">{{$loop->iteration}}</td>
@endif

    @foreach($headingKey as $key)
    


<?php

  //dd($data);
 ?>

     <td  title="{{ $data['List-array'][$key] }} ">

      @if((string)$object->$key ===  '0')


          @if($key == "CurrentStatus")


              @if(in_array($key, $data['List-dynamic-column']))




              <?php

              $class="\\".$data['Module-Namespace']."\\Logics";
             // dd($class);
              $func="get".$key;

              ?>

              {{ $class::$func($object->$key) }}
              @else

              {{ $object->$key }} 
              @endif





          @else

           <i class="fa fa-times text-danger"></i>
          @endif

     
      @elseif((string )$object->$key === '1')


      <i class="fa fa-check text-success"></i>


      @else


      
  
   @if(count($data['List-dynamic-column']) > 0)


          
          @if(in_array($key, $data['List-dynamic-column']))




            <?php


  


            $class="\\".$data['Module-Namespace']."\\Logics";

            $func="get".$key;
        

            ?>

            {{ $class::$func($object->$key) }}
          
          @else
          
            {{ $object->$key }} 
          @endif


       @else


        {{ $object->$key }} 
       @endif


      @endif

      </td>

        
    @endforeach


    @if(array_key_exists('edit-btn',$data['List-action']) or (array_key_exists('delete-btn',$data['List-action']) or array_key_exists('LoginasAgency-btn',$data['List-action']))   )

    <td>

        <?php  $icon='fa fa-file-text-o';
               $vName='';


         ?>

      <div class="btn-group btn-group-xs " role="group" aria-label="...">
        @if(array_key_exists('edit-btn',$data['List-action']))

          @if(array_key_exists('access',$data['List-action']['edit-btn']))

    
              @if(\B\Users\Logics::getUserCode(session('user.userData.UniqId'))  >  $data['List-action']['edit-btn']['access'] )

               <button type="button" class="btn  ms-text-black btn-success ms-mod-btn" ms-live-link="{{route($data['List-action']['edit-btn']['method'],\MS\Core\Helper\Comman::en4url($object->$data['List-action']['edit-btn']['key']))}}"><i class="fa fa-pencil "></i></button>

              @else

              

                  @if($object->$data['List-action']['edit-btn']['key'] === session('user.userData.UniqId'))
                    <button type="button" class="btn  ms-text-black btn-success ms-mod-btn" ms-live-link="{{route($data['List-action']['edit-btn']['method'],\MS\Core\Helper\Comman::en4url($object->$data['List-action']['edit-btn']['key']))}}"><i class="fa fa-pencil "></i></button>
                  @endif
              
              @endif

          @else
               <button type="button" class="btn  ms-text-black btn-success ms-mod-btn" ms-live-link="{{route($data['List-action']['edit-btn']['method'],\MS\Core\Helper\Comman::en4url($object->$data['List-action']['edit-btn']['key']))}}"><i class="fa fa-pencil "></i></button>
          @endif
        @endif



        @if(array_key_exists('delete-btn',$data['List-action']))
        <button type="button" class="btn btn-danger ms-text-black ms-mod-btn" ms-live-link="{{route($data['List-action']['delete-btn']['method'],\MS\Core\Helper\Comman::en4url($object->$data['List-action']['delete-btn']['key']))}}"><i class="fa fa-trash"></i></button>
        @endif
        @if(array_key_exists('AllocationLater-btn',$data['List-action']))
        <?php 
        if(array_key_exists('icon',$data['List-action']['AllocationLater-btn']))$icon=$data['List-action']['AllocationLater-btn']['icon'];
        if(array_key_exists('vName',$data['List-action']['AllocationLater-btn']))$vName=$data['List-action']['AllocationLater-btn']['vName'];
         ?>
        <button type="button" class="btn  ms-text-black btn-info ms-mod-btn" ms-live-link="{{route($data['List-action']['AllocationLater-btn']['method'],\MS\Core\Helper\Comman::en4url($object->$data['List-action']['AllocationLater-btn']['key']))}}"><i class="{{$icon}}"></i></button>
        @endif
       
        @if(array_key_exists('LoginasAgency-btn',$data['List-action']))
        <?php 
        if(array_key_exists('icon',$data['List-action']['LoginasAgency-btn']))$icon=$data['List-action']['LoginasAgency-btn']['icon']; 
        if(array_key_exists('vName',$data['List-action']['LoginasAgency-btn']))$vName=$data['List-action']['LoginasAgency-btn']['vName'];
        ?>
        <button type="button" class="btn  ms-text-black btn-info ms-mod-btn" ms-live-link="{{route($data['List-action']['LoginasAgency-btn']['method'],\MS\Core\Helper\Comman::en4url($object->$data['List-action']['LoginasAgency-btn']['key']))}}?agencyCode={{$object->$data['List-action']['LoginasAgency-btn']['key']}}"><i class="{{$icon}}"></i>  {{ $vName}}</button>
        @endif
       



      </div>

    </td>

    @endif

  @if(array_key_exists('ms-action-btn',$data['List-action']))
      <?php
      $textcolor= " ";
      $btnColor="btn-info";
      $link=" ";
      if(array_key_exists('extraClassData',$data['List-action']['ms-action-btn'])){

          if(array_key_exists('btn-text-color',$data['List-action']['ms-action-btn']['extraClassData'])){
            $textcolor=$data['List-action']['ms-action-btn']['extraClassData']['btn-text-color'];
          }
          if(array_key_exists('btn-color',$data['List-action']['ms-action-btn']['extraClassData'])){
              $btnColor=$data['List-action']['ms-action-btn']['extraClassData']['btn-color'];
          }

      }

      if ( array_key_exists('DBFunda',$data['List-action']['ms-action-btn']) ){


          if(array_key_exists('raw', $data['List-action']['ms-action-btn']['DBFunda'])){


              $para=[];
              foreach ($data['List-action']['ms-action-btn']['DBFunda']['raw'] as $key=>$value){

                  if(gettype ($value) == 'array'){

                      $para[$key]= \MS\Core\Helper\Comman::en4url  ( $object->$value[0]);
                  }else{
                      $para[$key]=$value;
                  }

              }
           // dd($para);
              $link=route($data['List-action']['ms-action-btn']['method'],$para);
          }



//dd($data['List-action']);
          if(array_key_exists('rawKey', $data['List-action']['ms-action-btn']['DBFunda']) && array_key_exists('rawKeyName', $data['List-action']['ms-action-btn']['DBFunda'])  ){




              $link=route($data['List-action']['ms-action-btn']['method'],
                  [
                  $data['List-action']['ms-action-btn']['DBFunda']['rawKeyName']=>$data['List-action']['ms-action-btn']['DBFunda']['rawKey'],

                  ]);


              }

      }

      ?>
    <td>
      @if(array_key_exists('icon',$data['List-action']['ms-action-btn']))

            @if(array_key_exists('downloadFile',$data['List-action']['ms-action-btn']))

                <button type="button" class="btn {{ $btnColor  }} {{ $textcolor  }} ms-href-btn" ms-live-link="{{$link}}" target="_blank"><i class="{{$data['List-action']['ms-action-btn']['icon']}}"></i></button>
                @else

                <button type="button" class="btn {{ $btnColor  }} {{ $textcolor  }} ms-mod-btn" ms-live-link="{{$link}}" ><i class="{{$data['List-action']['ms-action-btn']['icon']}}"></i></button>
                @endif



        @else

            <button type="button" class="btn {{ $btnColor  }} {{ $textcolor  }} ms-mod-btn" ms-live-link="{{$link}}" >{{ $data['List-action']['ms-action-btn']['displayText']  }}  </button>


        @endif
    </td>
  @endif


  @endforeach
   </tbody>

  
  </table>

    @if(array_key_exists('paginate',(array) $data['List-extraData'] ) )


        @if((boolean) $data['List-extraData'] ['paginate'] )

              <div class="panel-footer">



                  {{ $data['List-Paginate']->links('Pages.Paginate') }}


              </div>
              @endif
            <?php //dd($data['List-extraData']); ?>
    @else
    <div class="panel-footer">
      


    {{ $data['List-Paginate']->links('Pages.Paginate') }}


    </div>
    @endif

</div>


<script type="text/javascript">


@include('L.jsFix')


</script>