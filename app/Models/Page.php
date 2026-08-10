<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Page extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'sections',
    ];

    protected function casts(): array
    {
        return [
            'sections' => 'array',
        ];
    }

    /**
     * @return MorphOne<SeoMeta, $this>
     */
    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }
}
