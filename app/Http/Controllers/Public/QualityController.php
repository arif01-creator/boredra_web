<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\QualityProcess;
use App\Services\SeoService;
use Inertia\Inertia;
use Inertia\Response;

class QualityController extends Controller
{
    public function __invoke(SeoService $seo): Response
    {
        return Inertia::render('quality', [
            'stages' => QualityProcess::where('status', 'published')->orderBy('sort_order')->get(),
            'seo' => $seo->forTitle('Quality & Process'),
        ]);
    }
}
