<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SeoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title.en' => ['nullable', 'string', 'max:255'],
            'title.bn' => ['nullable', 'string', 'max:255'],
            'meta_description.en' => ['nullable', 'string', 'max:320'],
            'meta_description.bn' => ['nullable', 'string', 'max:320'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'og_title.en' => ['nullable', 'string', 'max:255'],
            'og_title.bn' => ['nullable', 'string', 'max:255'],
            'og_description.en' => ['nullable', 'string', 'max:320'],
            'og_description.bn' => ['nullable', 'string', 'max:320'],
            'og_image' => ['nullable', 'url', 'max:255'],
            'robots' => ['nullable', 'string', 'max:100'],
        ];
    }
}
