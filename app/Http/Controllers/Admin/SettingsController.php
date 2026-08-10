<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingsRequest;
use App\Services\MediaService;
use App\Services\SettingsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    public function edit(SettingsService $settings): View
    {
        return view('admin.settings.edit', ['settings' => $settings->all()]);
    }

    public function update(SettingsRequest $request, SettingsService $settings, MediaService $mediaService): RedirectResponse
    {
        $data = $request->safe()->except(['company_profile_pdf', 'hero_media']);
        $data['responsibility_section_enabled'] = $request->boolean('responsibility_section_enabled') ? '1' : '0';

        if ($request->hasFile('company_profile_pdf')) {
            $data['company_profile_pdf'] = $mediaService->storeAndUrl($request->file('company_profile_pdf'), 'documents');
        }

        if ($request->hasFile('hero_media')) {
            $data['hero_media'] = $mediaService->storeAndUrl($request->file('hero_media'), 'hero');
        }

        $settings->setMany($data);

        return redirect()->route('admin.settings.edit')->with('toast', ['type' => 'success', 'message' => 'Settings saved.']);
    }
}
