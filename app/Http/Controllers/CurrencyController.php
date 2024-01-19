<?php

namespace App\Http\Controllers;

use App\Models\Currencies;
use Illuminate\Http\Request;
use Money\Currency;

class CurrencyController extends Controller
{
    public function currencyload(Request $request)
    {

        session()->put('currency_code',$request->currency_code);
        
        $currency=Currencies::where('code',$request->currency_code)->first();

        session()->put('currency_symbol',$currency->symbol);

        session()->put('currency_exchange_rate',$currency->exchange_rate);

        $response['status']=true;

        return $response;
    }

}
