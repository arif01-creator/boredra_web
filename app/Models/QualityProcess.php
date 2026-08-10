<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualityProcess extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'sort_order',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }
}
