<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SettingsService
{
    private const CACHE_KEY = 'site_settings';

    /**
     * @return array<string, string|null>
     */
    public function all(): array
    {
        return Cache::rememberForever(self::CACHE_KEY, fn () => SiteSetting::query()->pluck('value', 'key')->all());
    }

    public function get(string $key, ?string $default = null): ?string
    {
        return $this->all()[$key] ?? $default;
    }

    public function set(string $key, ?string $value): void
    {
        SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        $this->flush();
    }

    /**
     * @param  array<string, string|null>  $values
     */
    public function setMany(array $values): void
    {
        foreach ($values as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $this->flush();
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
