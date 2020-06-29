<?php

namespace App\Http\Middleware;

use Closure, Session, Auth;

class EmitenRole
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
        if (Auth::user()->USER_ROLE_ID==2)
        {
            return $next($request);
        }
        return redirect('/dashboard');
    }
}
