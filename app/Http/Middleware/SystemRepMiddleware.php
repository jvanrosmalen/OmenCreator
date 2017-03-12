<?php

namespace App\Http\Middleware;

use Closure;

class SystemRepMiddleware
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
    	if(!Auth::guest() && Auth::user()->isSystemRep){
    		return $next($request);	
    	}
    	
        return redirect('/');
    }
}
