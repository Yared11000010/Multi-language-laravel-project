<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Chapa\Chapa\Facades\Chapa as Chapa;


class ChapaController extends Controller
{

    public function index(){

        return view('chapa.index');
    }
    protected $reference;

    public function __construct(){
        $this->reference = Chapa::generateReference();

    }


    public function initialize()
    {
        //This generates a payment reference
        $reference = $this->reference;



        // Enter the details of the payment
        $data = [

            'amount' => 100,
            'email' => 'hi@negade.com',
            'tx_ref' => $reference,
            'currency' => "ETB",
            'callback_url' => route('callback',[$reference]),
            'first_name' => "Israel",
            'last_name' => "Goytom",
            "customization" => [
                "title" => 'Test',
                "description" => "I amma testing this"
            ]
        ];


        $payment = Chapa::initializePayment($data);

        // dd($payment);
        if ($payment['status'] !== 'success') {
            // notify something went wrong

            return redirect()->back();
        }

        return redirect($payment['data']['checkout_url']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback($reference)
    {

        $data = Chapa::verifyTransaction($reference);
        dd($data);

        //if payment is successful
        if ($data['status'] ==  'success') {
        dd($data);
        }
        else{
            //oopsie something ain't right.
        }


    }

    public function success(){
        return view('chapa.success');
    }

    public function error(){

        return view('chapa.error');
    }
}
