<?php

namespace App\Http\Controllers;

use App\Models\Currencies;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ExchangeRateController extends Controller
{
    private $apiKey = 'cur_live_E7AMr20GbBK4AiZrmUtpPhYhUzrVQldtBNA64Mwj';

    public function getExchangeRate()
    {
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

        $allcurrency=Currencies::all();

        return view('displaycurrency',compact('allcurrency'));
        // Store data in the database (you need to create a migration for the exchange_rates table)
        // Example: ExchangeRate::create(['currency' => 'USD', 'rate' => $data['rates']['USD']]);
    }
}
