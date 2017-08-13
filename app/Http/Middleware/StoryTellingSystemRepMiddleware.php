<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StoryTellingSystemRepMiddleware
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
    	if(!Auth::guest() &&
    			(	Auth::user()->is_system_rep ||
    				Auth::user()->is_story_telling ||
    				Auth::user()->is_admin)){
    		return $next($request);	
    	}
    	
        return redirect('/illegal_link');
    }
}
