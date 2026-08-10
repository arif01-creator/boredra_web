@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
    <x-admin.breadcrumbs :items="[['label' => 'Settings']]" />

    @if ($errors->any())
        <x-admin.alert type="error">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-admin.alert>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="max-w-2xl space-y-8">
        @csrf
        @method('PUT')

        <div class="space-y-5 rounded border border-stone bg-white p-6">
            <p class="text-xs font-medium tracking-wide text-moss uppercase">Company</p>
            <x-admin.input name="company_name" label="Company Name" :value="$settings['company_name'] ?? ''" />
            <x-admin.input name="company_address" label="Address" :value="$settings['company_address'] ?? ''" />
            <x-admin.input name="company_phone" label="Phone" :value="$settings['company_phone'] ?? ''" />
            <x-admin.input name="company_email" label="Email" type="email" :value="$settings['company_email'] ?? ''" />
        </div>

        <div class="space-y-5 rounded border border-stone bg-white p-6">
            <p class="text-xs font-medium tracking-wide text-moss uppercase">Social Links</p>
            <x-admin.input name="social_facebook" label="Facebook URL" :value="$settings['social_facebook'] ?? ''" />
            <x-admin.input name="social_linkedin" label="LinkedIn URL" :value="$settings['social_linkedin'] ?? ''" />
            <x-admin.input name="social_instagram" label="Instagram URL" :value="$settings['social_instagram'] ?? ''" />
        </div>

        <div class="space-y-5 rounded border border-stone bg-white p-6">
            <p class="text-xs font-medium tracking-wide text-moss uppercase">Company Profile</p>
            <div>
                <label class="mb-1.5 block text-xs font-medium tracking-wide text-moss uppercase">Company Profile PDF</label>
                @if ($settings['company_profile_pdf'] ?? null)
                    <p class="mb-2 text-xs text-moss"><a href="{{ $settings['company_profile_pdf'] }}" class="underline" target="_blank">Current file ↗</a></p>
                @endif
                <input type="file" name="company_profile_pdf" accept="application/pdf"
                    class="block w-full text-sm text-charcoal file:mr-3 file:rounded file:border-0 file:bg-forest-deep file:px-3 file:py-1.5 file:text-xs file:tracking-wide file:text-ivory file:uppercase">
            </div>
        </div>

        <div class="space-y-5 rounded border border-stone bg-white p-6">
            <p class="text-xs font-medium tracking-wide text-moss uppercase">Sections</p>
            <label class="flex items-center gap-2 text-sm text-charcoal">
                <input type="checkbox" name="responsibility_section_enabled" value="1" @checked(($settings['responsibility_section_enabled'] ?? '0') === '1')>
                Show "Responsible by Approach" section on the homepage
            </label>
        </div>

        <x-admin.button type="submit" variant="primary">Save Settings</x-admin.button>
    </form>
@endsection
