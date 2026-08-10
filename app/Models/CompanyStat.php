<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CompanyStat extends Model
{
    use HasTranslations;

    protected $fillable = [
        'label',
        'value',
        'sort_order',
        'status',
    ];

    /**
     * @var array<int, string>
     */
    public array $translatable = ['label', 'value'];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }
}
