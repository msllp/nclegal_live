<?php

namespace MS\Core\Patch;

use Closure;

class CheckAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   



       $type=explode('/',$request->path())[0];
       $userType='agency';
       $adminType='adminType';


      // dd($request->path());
     
       
        if( !session()->has('agent') ){
           return redirect()->route("AAMS.Agent.Login");
        }
           

         
      //  dd($request->path());

        return $next($request);
    }


}
