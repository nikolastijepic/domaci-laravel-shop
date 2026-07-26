<?php

namespace App\Console\Commands;

use App\Models\ExchangeRates;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

#[Signature('app:currency-rate')]
#[Description('Command description')]
class CurrencyRateCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://api.exchangerate.fun/latest?base=USD');
        $data = $response->json();

        $date = Carbon::createFromTimestamp($data['timestamp']);

        $this->info("Currency: {$data['base']}");
        $this->info("Updated: " . $date->format('d.m.Y H:i:s'));

        foreach (ExchangeRates::AVAILABLE_CURRENCY as $currency) {

            $todayCurrency = ExchangeRates::getCurrencyForToday($currency);

            if ($todayCurrency !== null) {
                continue;
            }

            ExchangeRates::create([
                'currency' => $currency,
                'value' => $data['rates'][$currency],
            ]);

            $this->info("USD/$currency exchange rate: {$data['rates'][$currency]} $currency");
        }
    }
}
