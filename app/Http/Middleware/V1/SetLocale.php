<?php

namespace App\Http\Middleware\V1;

use Closure;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('locale') && in_array($request->get('locale'), ['en', 'zh-TW'])) {
            $locale = Str::replace($request->get('locale'), '-', '_');
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
