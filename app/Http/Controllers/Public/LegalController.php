<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\SeoService;
use Inertia\Inertia;
use Inertia\Response;

class LegalController extends Controller
{
    public function privacy(SeoService $seo): Response
    {
        return Inertia::render('privacy', [
            'page' => Page::where('slug', 'privacy')->first(),
            'seo' => $seo->forPageSlug('privacy', 'Privacy Policy'),
        ]);
    }

    public function terms(SeoService $seo): Response
    {
        return Inertia::render('terms', [
            'page' => Page::where('slug', 'terms')->first(),
            'seo' => $seo->forPageSlug('terms', 'Terms of Service'),
        ]);
    }
}
