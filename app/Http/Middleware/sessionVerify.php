<?php

namespace App\Http\Middleware;

use Closure;

class sessionVerify
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
      if($request->session()->has('user'))
      {
        return $next($request);
      }
      else
      {
        return redirect()->route('login.index');
      }
    }
}
