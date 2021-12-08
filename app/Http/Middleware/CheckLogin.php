<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   //dd($request);
        if($request->path()=="adminlogin" && $request->session()->has('alfa')){
            return redirect('/admin');
        }
        return $next($request);
    }
}
