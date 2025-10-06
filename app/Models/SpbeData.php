<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpbeData extends Model
{
    protected $fillable = [
        'province_name',
        'spbe_index',
        'architecture_implementation',
        'ict_budget_approved',
        'ict_budget_total',
        'serabi_score',
        'year'
    ];

    // Architecture domains scores
    protected $casts = [
        'architecture_domains' => 'array',
    ];
}
