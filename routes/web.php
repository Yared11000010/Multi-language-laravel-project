<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExchangeRateController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Payment\ChapaController;
use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/languageDemo', 'App\Http\Controllers\HomeController@languageDemo');

Route::post('currency_load',[CurrencyController::class,'currencyload'])->name('currency.load');
Route::get('exchange',[ExchangeRateController::class,'getExchangeRate'])->name('exchange');
Route::get('products',[HomeController::class,'convert'])->name('products');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//for paypal

// Show checkout page
Route::controller(PaymentController::class)
    ->prefix('paypal')
    ->group(function () {
        Route::view('payment', 'paypal.index')->name('create.payment');
        Route::get('handle-payment', 'handlePayment')->name('make.payment');
        Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
        Route::get('payment-success', 'paymentSuccess')->name('success.payment');
    });

    Route::get('chapa',[ChapaController::class,'index'])->name('chapa');

    Route::post('pay', 'App\Http\Controllers\Payment\ChapaController@initialize')->name('pay');
    // The callback url after a payment
    Route::get('callback/{reference}', 'App\Http\Controllers\Payment\ChapaController@callback')->name('callback');

    Route::get('success/payment', [ChapaController::class, 'success'])->name('successfull.payment');
    Route::get('error/payment', [ChapaController::class,'error'])->name('error.payment');


