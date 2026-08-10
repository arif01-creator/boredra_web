<?php

namespace App\Http\Requests\Admin;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $product = $this->route('product');
        $productId = $product instanceof Product ? $product->id : null;

        return [
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'name.en' => ['required', 'string', 'max:255'],
            'name.bn' => ['nullable', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'short_description.en' => ['nullable', 'string', 'max:255'],
            'short_description.bn' => ['nullable', 'string', 'max:255'],
            'long_description.en' => ['nullable', 'string'],
            'long_description.bn' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'specifications.en' => ['nullable', 'array'],
            'specifications.en.*' => ['nullable', 'string', 'max:255'],
            'specifications.bn' => ['nullable', 'array'],
            'specifications.bn.*' => ['nullable', 'string', 'max:255'],
            'applications.en' => ['nullable', 'array'],
            'applications.en.*' => ['nullable', 'string', 'max:255'],
            'applications.bn' => ['nullable', 'array'],
            'applications.bn.*' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
