
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                
                <span role="presentation" >

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
    @include('AAMS.V.Object.Left')

    @include('AAMS.V.Object.Right')
</div>

 
        </nav>