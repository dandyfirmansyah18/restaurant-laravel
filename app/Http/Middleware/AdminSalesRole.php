<?php

namespace App\Http\Middleware;

use Closure, Session, Auth;

class AdminSalesRole
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
        if (Auth::user()->USER_ROLE_ID==3 || Auth::user()->USER_ROLE_ID==1)
        {
            return $next($request);
        }
        return redirect('/dashboard');
    }
}
