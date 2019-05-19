<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CouncilMember
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
        if(Auth::user()->type == 2){
            return $next($request);
        }
        else{
            return redirect()->to('dashboard');
        }
    }
}
