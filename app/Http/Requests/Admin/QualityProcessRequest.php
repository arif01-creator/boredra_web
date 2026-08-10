<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QualityProcessRequest extends FormRequest
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
            'title.en' => ['required', 'string', 'max:255'],
            'title.bn' => ['nullable', 'string', 'max:255'],
            'description.en' => ['nullable', 'string'],
            'description.bn' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
