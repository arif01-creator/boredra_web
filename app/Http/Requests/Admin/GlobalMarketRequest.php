<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GlobalMarketRequest extends FormRequest
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
            'country.en' => ['required', 'string', 'max:255'],
            'country.bn' => ['nullable', 'string', 'max:255'],
            'description.en' => ['nullable', 'string'],
            'description.bn' => ['nullable', 'string'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
