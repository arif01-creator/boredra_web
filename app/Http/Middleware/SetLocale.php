<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * @var array<int, string>
     */
    public const SUPPORTED = ['en', 'bn'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = (string) $request->route('locale');

        abort_unless(in_array($locale, self::SUPPORTED, true), 404);

        App::setLocale($locale);
        URL::defaults(['locale' => $locale]);

        $response = $next($request);
        $response->headers->setCookie(cookie('locale', $locale, 60 * 24 * 365));

        return $response;
    }
}
