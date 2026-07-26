<?php

namespace App\Console\Commands;

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
        $this->info("USD/EUR exchange rate:: {$data['rates']['EUR']} EUR");
        $this->info("USD/BAM exchange rate:: {$data['rates']['BAM']} KM");
        $this->info("USD/RSD exchange rate:: {$data['rates']['RSD']} DIN");
    }
}
