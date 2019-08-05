<?php

namespace App\Http\Middleware;

use Closure;
use Route;
use Illuminate\Support\Facades\Auth;
class AuthenLogin
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
        
        if(Auth::check() && Auth::user()->type==0){
            if(Route::currentRouteName()==='frmlogin' || Route::currentRouteName()==='frmregister'){
                return redirect('/');
            }
            return $next($request);
        }else{
            if(Route::currentRouteName()==='frmlogin'){
                return $next($request);
            }
        }
        return redirect('/dang-nhap');
    }
}
