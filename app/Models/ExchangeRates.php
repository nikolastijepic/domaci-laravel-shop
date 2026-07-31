<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ExchangeRates extends Model
{
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_BAM = 'BAM';
    const CURRENCY_RSD = 'RSD';

    const AVAILABLE_CURRENCY = [
        self::CURRENCY_EUR, self::CURRENCY_BAM, self::CURRENCY_RSD,
    ];

    protected $table = 'exchange_rates';

    protected $fillable = ['currency', 'value'];

    public static function getCurrencyForToday($currency)
    {
        return self::where('currency', $currency)
            ->whereDate('created_at', Carbon::today())
            ->first();
    }
}



