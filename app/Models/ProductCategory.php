<?php

namespace App\Models;

use App\Concerns\SerializesCurrentLocale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class ProductCategory extends Model
{
    use HasTranslations, SerializesCurrentLocale;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'sort_order',
        'status',
    ];

    /**
     * @var array<int, string>
     */
    public array $translatable = ['name', 'description'];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    /**
     * @return HasMany<Product, $this>
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return HasMany<Product, $this>
     */
    public function publishedProducts(): HasMany
    {
        return $this->products()->where('status', 'published')->orderBy('sort_order');
    }
}
