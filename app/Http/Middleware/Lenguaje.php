<?php

namespace App\Http\Middleware;

use Closure;

class Lenguaje
{
    /**
     * Handle an incoming request.
     * Per comprobar el idioma de la pagina
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session()->has('locale'))
            app()->setLocale(session('locale'));
        else 
            app()->setLocale(config('app.locale'));

        return $next($request);
    }
}
