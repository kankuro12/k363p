<?php

namespace App\Http\Middleware;

use Closure;

class Referal
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
        if($request->filled('ref_id')){
            session(['ref_id'=>$request->ref_id]);
        }
        return $next($request);
    }
}
