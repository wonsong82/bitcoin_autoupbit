<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricesRecord extends Model
{
    protected $fillable = [
        'recorded_at'
    ];

    protected $dates = [
        'recorded_at'
    ];


    // Properties


    // Static Functions


    // Functions


    // Scopes


    // Relations
    public function prices_record_lines()
    {
        return $this->hasMany(PricesRecordLine::class);
    }
}
