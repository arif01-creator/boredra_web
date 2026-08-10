<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\CompanyStat;
use App\Models\GlobalMarket;
use App\Models\Page;
use App\Models\Product;
use App\Models\QualityProcess;
use App\Models\ResponsibilityItem;
use App\Services\SeoService;
use App\Services\SettingsService;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function __invoke(SeoService $seo, SettingsService $settings): Response
    {
        $responsibilityEnabled = $settings->get('responsibility_section_enabled', '0') === '1';

        return Inertia::render('home', [
            'heroImage' => $settings->get('hero_media') ?: null,
            'intro' => Page::where('slug', 'home-intro')->first(),
            'about' => Page::where('slug', 'about')->first(),
            'products' => Product::with('category')->where('status', 'published')->orderBy('sort_order')->get(),
            'qualityStages' => QualityProcess::where('status', 'published')->orderBy('sort_order')->get(),
            'markets' => GlobalMarket::where('status', 'published')->orderBy('display_order')->get(),
            'stats' => CompanyStat::where('status', 'published')->orderBy('sort_order')->get(),
            'responsibility' => $responsibilityEnabled
                ? [
                    'page' => Page::where('slug', 'responsibility')->first(),
                    'items' => ResponsibilityItem::where('status', 'published')->orderBy('sort_order')->get(),
                ]
                : null,
            'seo' => $seo->forTitle(
                'Exceptional Materials. Global Possibilities.',
                null,
                [$seo->websiteSchema()],
            ),
        ]);
    }
}
