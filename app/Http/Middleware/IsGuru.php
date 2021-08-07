<?php

namespace App\Http\Middleware;
use Closure;

class IsGuru

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
        if(auth()->user()->role == 'guru'){
            return $next($request);
        }
        return redirect('login')->withSuccess("Anda tidak punya akses guru!");
    }
}