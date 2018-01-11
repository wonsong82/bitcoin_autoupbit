<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricesRecordLine extends Model
{
    protected $fillable = [
        'price_record_id',
        'currency_id',
        'base_price',
        'premium_price',
        'premium_amount',
        'premium_rate',

        'sd_bp_5',
        'sd_bp_10',
        'sd_bp_30',
        'sd_bp_60',
        'sd_bp_120',
        'sd_bp_240',

        'sd_pp_5',
        'sd_pp_10',
        'sd_pp_30',
        'sd_pp_60',
        'sd_pp_120',
        'sd_pp_240',

        'sd_pr_5',
        'sd_pr_10',
        'sd_pr_30',
        'sd_pr_60',
        'sd_pr_120',
        'sd_pr_240',
    ];



    // Relations
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }


}
