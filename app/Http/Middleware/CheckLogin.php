<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;


class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $userSessionInfo = $request->session()->get('userinfo','');
        if($userSessionInfo == "" ){
            return redirect('/');
        }
        return $next($request);
    }
}
