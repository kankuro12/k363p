<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Authen
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
        $redirectTo='/';
        if(!Auth::guard('web')->check()){
            $actions=$request->route()->getAction();
            if(isset($actions['type'])){
                $type=$actions['type'][0];
                if($type){
                    if($type=='user'){

                        return redirect()->route('n.user.login');
                    }elseif($type=='vendor'){
                        $redirectTo='vendor/login';
                    }
                }
            }

        }
        return $next($request);
    }
}
