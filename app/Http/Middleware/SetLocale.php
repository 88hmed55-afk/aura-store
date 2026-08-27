<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('lang')) {
            $lang = $request->get('lang');
            if (in_array($lang, ['ar', 'en'])) {
                session(['locale' => $lang]);
            }
        }

        $locale = session('locale', 'ar');
        App::setLocale($locale);

        return $next($request);
    }
}
