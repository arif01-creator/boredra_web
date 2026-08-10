<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\CompanyStat;
use App\Models\Page;
use App\Services\SeoService;
use Inertia\Inertia;
use Inertia\Response;

class AboutController extends Controller
{
    public function __invoke(SeoService $seo): Response
    {
        return Inertia::render('about', [
            'about' => Page::where('slug', 'about')->first(),
            'stats' => CompanyStat::where('status', 'published')->orderBy('sort_order')->get(),
            'seo' => $seo->forPageSlug('about', 'About'),
        ]);
    }
}
