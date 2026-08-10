<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyStatRequest extends FormRequest
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
            'label.en' => ['required', 'string', 'max:255'],
            'label.bn' => ['nullable', 'string', 'max:255'],
            'value.en' => ['required', 'string', 'max:255'],
            'value.bn' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
