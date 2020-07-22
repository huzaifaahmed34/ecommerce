<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session ;
  class RedirectIfAuthenticated
    {
        public function handle($request, Closure $next, $guard = null)
        {
            
        switch ($guard) {
             case 'customer':
                 $link='/admin';
                 break;
             
             default:
                $link='/CustomerLogin';
                 break;
         } 

      if (Auth::guard($guard)->check()) {
                return redirect($link);
            }

            return $next($request);
        }
    }