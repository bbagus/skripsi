<?php

namespace App\Http\Middleware;
use Closure;

class IsSiswa

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
        if(auth()->user()->role == 'siswa'){
            return $next($request);
        }
        return redirect('login')->withSuccess("Anda tidak punya akses siswa!");
    }
}