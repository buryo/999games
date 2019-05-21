<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if (auth()->check()){ //first check if user is logged in, otherwise it cannot find the role and it will give an error
            if (auth()->user()->isAdmin()){ // check if authenticated user is admin
                return $next($request);
            }
        }
        return abort('403'); //return 403 error page
    }
}
