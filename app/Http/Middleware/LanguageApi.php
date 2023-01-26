<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageApi
{
    public function handle($request, Closure $next)
    {
        $request->header('lang')  ? App::setLocale($request->header('lang')) : App::setLocale('ar');

        return $next($request);
    }
}
