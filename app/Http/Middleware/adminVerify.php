<?php

namespace App\Http\Middleware;

use Closure;

class adminVerify
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
      if($request->session()->get('user')=="Admin")
      {
        return $next($request);
      }
      else
      {
        return redirect()->route('login.index');
      }
    }
}
