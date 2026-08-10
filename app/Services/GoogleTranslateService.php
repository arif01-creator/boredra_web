<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class GoogleTranslateService
{
    /**
     * @throws RuntimeException when the API key is missing or the request fails
     */
    public function translate(string $text, string $target, string $source = 'en', string $format = 'text'): string
    {
        $apiKey = config('services.google_translate.key');

        if (blank($apiKey)) {
            throw new RuntimeException('Google Translate API key is not configured. Add GOOGLE_TRANSLATE_API_KEY to your .env file.');
        }

        $response = Http::asForm()->post('https://translation.googleapis.com/language/translate/v2', [
            'key' => $apiKey,
            'q' => $text,
            'source' => $source,
            'target' => $target,
            'format' => $format,
        ]);

        if ($response->failed()) {
            throw new RuntimeException($response->json('error.message') ?? 'Translation request failed.');
        }

        $translated = $response->json('data.translations.0.translatedText');

        if (! is_string($translated)) {
            throw new RuntimeException('Translation response was empty.');
        }

        return $translated;
    }
}
