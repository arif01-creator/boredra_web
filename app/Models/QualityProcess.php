<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class QualityProcess extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'image',
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
