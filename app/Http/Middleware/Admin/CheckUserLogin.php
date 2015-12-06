<?php

/* 
 * 检查员工是否登录
 */

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;
use URL;
use Request;

class CheckUserLogin
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
        if (!Auth::check()) {
            return redirect()->action("Admin\LoginController@index",'callback='.base64_encode(Request::getRequestUri()));
        }
        return $next($request);
    }
}

