<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Redirect;
class CheckLoginSeller
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
        $sellerSystem = Session::get('sellerSystem');
        $adminSystem = Session::get('adminSystem');
        if($adminSystem == true && $sellerSystem == true){
            return Redirect::to('logout');
        }
        if($sellerSystem == true){
            return $next($request);
        }else{
            return Redirect::to('login-page');
        }
    }
}
