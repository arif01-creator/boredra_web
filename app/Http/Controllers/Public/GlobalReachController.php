<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GlobalMarket;
use App\Services\SeoService;
use Inertia\Inertia;
use Inertia\Response;

class GlobalReachController extends Controller
{
    public function __invoke(SeoService $seo): Response
    {
        return Inertia::render('global-reach', [
            'markets' => GlobalMarket::where('status', 'published')->orderBy('display_order')->get(),
            'seo' => $seo->forTitle('Global Reach'),
        ]);
    }
}
