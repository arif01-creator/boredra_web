<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyStat extends Model
{
    protected $fillable = [
        'label',
        'value',
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
