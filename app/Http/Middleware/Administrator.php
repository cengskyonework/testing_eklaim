<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;
use Auth;

class Administrator
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
		
		if(Auth::User()->user_type != 'administrator'){
			if( ! $request->ajax()){
			   return back()->with('error',_lang('Sorry, Only admin can perform this action !'));
			}else{
				return new Response('<h5 class="text-center red">'._lang('Sorry, Only administrator can perform this action !').'</h5>');
			}		
		}
		
        return $next($request);
    }
}
