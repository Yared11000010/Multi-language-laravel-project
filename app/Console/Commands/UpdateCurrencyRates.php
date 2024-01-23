<?php

namespace App\Console\Commands;

use App\Models\Currencies;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-currency-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    private $apiKey = 'cur_live_E7AMr20GbBK4AiZrmUtpPhYhUzrVQldtBNA64Mwj';

    public function handle()
    {
        //
        $client = new Client();
        $response = $client->get("https://currencyapi.com/api/v3/latest?apikey={$this->apiKey}&base_currency=ETB");
        $data = json_decode($response->getBody(), true);

        // dd($data['data']);

        $currenciesToStore = ['USD', 'ETB'];
        foreach ($currenciesToStore as $currencyCode) {
            if (isset($data['data'][$currencyCode])) {
                $currencyValues[$currencyCode] = $data['data'][$currencyCode]['value'];
            }
        }

        // // Display the fetched currency values
        // dd($currencyValues);
        foreach ($currencyValues as $currencyCode => $value) {
            Currencies::updateOrCreate(
                ['code' => $currencyCode],
                ['exchange_rate' => $value]
            );
        }
    }
    
}
