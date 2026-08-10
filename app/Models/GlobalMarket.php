<?php

namespace App\Models;

use App\Concerns\SerializesCurrentLocale;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GlobalMarket extends Model
{
    use HasTranslations, SerializesCurrentLocale;

    protected $fillable = [
        'country',
        'description',
        'latitude',
        'longitude',
        'display_order',
        'status',
    ];

    /**
     * @var array<int, string>
     */
    public array $translatable = ['country', 'description'];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'display_order' => 'integer',
        ];
    }
}
