<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code',
        'name',
        'name_kr',
        'base_pair',
        'base_pair_intermediate',
        'premium_pair',
        'premium_pair_intermediate',
        'is_active',
        'order'
    ];

    // Properties


    // Static Functions
    public static function findByCode($code)
    {
        return self::filterByCode($code)->first();
    }


    // Functions


    // Scope
    public function scopeFilterByCode($query, $code)
    {
        $query->where('code', $code);
    }

    public function scopeActive($query)
    {
        $query->where('is_active', true);
    }


    // Relations
}
