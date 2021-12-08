<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   //dd($request->session()->has('alfa'));
        if (!$request->session()->has('alfa')) {
            return redirect('/adminlogin');
        }
        return $next($request);
    }
}
