<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                
                <span role="presentation" class="ms-live-btn ms-history-btn" ms-live-link="{{route('APanel.Index.Data.Side')}}" ms-shortcut="h">

                  <img class="ms-logo" src="{{asset('images/'.env('APP_V_LOGO','billing.png'))}}" />
                     </span>




                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
            </div>
<div class="collapse navbar-collapse" >
    @include('APanel.V.Object.Left')

    @include('APanel.V.Object.Right')
</div>

 
        </nav>