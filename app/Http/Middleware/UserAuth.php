<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuth
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
        if (Auth::guest()) { // 如果用户未通过身份验证
            return redirect('login'); // 重定向到登录页面
        }

        return $next($request); // 如果用户已通过身份验证，则继续处理请求
    }
}