<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isblock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next):Response
    {
        if(auth()->check())
        {
            
       
        $admin = Auth::user()->admin_block;
        if($admin == 0){
            return $next($request);
        }
        else{
            auth()->logout();
            return redirect()->route('login')->with('mesaj2', __('messages.hesabbloklandi'));
        }
     }
        return $next($request);
        
    }
}
