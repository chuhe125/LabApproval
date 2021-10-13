<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthorityAuthentication
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
//        $response = $next($request);
//
//        $data = Auth::user();
//        //echo $data;
//        if($data['status'] != $request['login_role'])
//        {
//            return abort(403,'抱歉，你没有权限访问！');
//        }
//        return $response;

        $data = Auth::user();
        echo $data;
        if($data['status'] != $request['login_role'] )
        {
            return abort(403,'抱歉，你没有权限访问！');
        }
        return $next($request);
    }
}
