<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GoogleTranslateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class TranslateController extends Controller
{
    public function __invoke(Request $request, GoogleTranslateService $translator): JsonResponse
    {
        $data = $request->validate([
            'text' => ['required', 'string', 'max:5000'],
            'target' => ['required', 'string', 'in:en,bn'],
            'source' => ['nullable', 'string', 'in:en,bn'],
            'format' => ['nullable', 'string', 'in:text,html'],
        ]);

        try {
            $translated = $translator->translate(
                text: $data['text'],
                target: $data['target'],
                source: $data['source'] ?? 'en',
                format: $data['format'] ?? 'text',
            );
        } catch (RuntimeException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json(['translated' => $translated]);
    }
}
