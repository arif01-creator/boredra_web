<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations, SoftDeletes;

    protected $fillable = [
        'product_category_id',
        'name',
        'slug',
        'short_description',
        'long_description',
        'featured_image',
        'specifications',
        'applications',
        'status',
        'sort_order',
    ];

    /**
     * @var array<int, string>
     */
    public array $translatable = [
        'name',
        'short_description',
        'long_description',
        'specifications',
        'applications',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<ProductCategory, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    /**
     * @return HasMany<ProductImage, $this>
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /**
     * @return MorphOne<SeoMeta, $this>
     */
    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
