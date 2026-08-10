<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalMarket extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'description',
        'latitude',
        'longitude',
        'display_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'display_order' => 'integer',
        ];
    }
}
