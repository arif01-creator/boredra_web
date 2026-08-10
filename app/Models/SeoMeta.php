<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Translatable\HasTranslations;

class SeoMeta extends Model
{
    use HasTranslations;

    protected $table = 'seo_metas';

    protected $fillable = [
        'title',
        'meta_description',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'robots',
        'schema_json',
    ];

    /**
     * @var array<int, string>
     */
    public array $translatable = ['title', 'meta_description', 'og_title', 'og_description'];

    protected function casts(): array
    {
        return [
            'schema_json' => 'array',
        ];
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
