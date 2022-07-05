<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->check() && auth()->user()->status == 0) { //user is blocked
            auth()->logout();     
            return redirect()->route('login')
                ->with('banMessage','Your account has been banned, please contact administrator.'); 
        }
        
        
        return $next($request);
    }
}
