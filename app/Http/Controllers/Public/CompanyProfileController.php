<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\SeoService;
use App\Services\SettingsService;
use Inertia\Inertia;
use Inertia\Response;

class CompanyProfileController extends Controller
{
    public function __invoke(SeoService $seo, SettingsService $settings): Response
    {
        return Inertia::render('company-profile', [
            'page' => Page::where('slug', 'company-profile')->first(),
            'settings' => [
                'company_email' => $settings->get('company_email'),
                'company_phone' => $settings->get('company_phone'),
                'company_profile_pdf' => $settings->get('company_profile_pdf'),
            ],
            'seo' => $seo->forPageSlug('company-profile', 'Company Profile', 'Registered exporting company based in Dakshinkhan, Dhaka, Bangladesh.'),
        ]);
    }
}
