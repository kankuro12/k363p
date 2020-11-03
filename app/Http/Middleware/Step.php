<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

use Illuminate\Support\Facades\Route;
class Step
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
        $user=$request->user();
        if(($user->role->name)=="vendor" && !Route::is('vendor.getLogout')){
            $vendor=$user->vendor;
            if($vendor->isverified==0){
                if($vendor->step==0 && !Route::is('vendor.step1')){
                    return redirect()->route('vendor.step1');
                }else if($vendor->step==1 && !Route::is('vendor.step2')){
                    return redirect()->route('vendor.step2');
                }else if($vendor->step==2 && !Route::is('vendor.step3')){
                    return redirect()->route('vendor.step3');
                }
            }           
        }
        return $next($request);
    }
}
