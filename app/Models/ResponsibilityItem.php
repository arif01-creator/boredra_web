<?php

namespace App\Models;

use App\Concerns\SerializesCurrentLocale;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ResponsibilityItem extends Model
{
    use HasTranslations, SerializesCurrentLocale;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'sort_order',
        'status',
    ];

    /**
     * @var array<int, string>
     */
    public array $translatable = ['title', 'description'];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }
}
