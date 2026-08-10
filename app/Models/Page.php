<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    protected $fillable = [
        'slug',
        'title',
        'sections',
    ];

    /**
     * @var array<int, string>
     */
    public array $translatable = ['title', 'sections'];

    /**
     * @return MorphOne<SeoMeta, $this>
     */
    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }
}
