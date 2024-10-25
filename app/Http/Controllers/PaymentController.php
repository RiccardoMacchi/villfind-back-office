<?php

namespace App\Http\Controllers;

use Braintree\Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        dd(env('BRAINTREE_ENV'));
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }

    public function token()
    {
        $clientToken = $this->gateway->clientToken()->generate();
        return response()->json(['token' => $clientToken]);
    }

    public function checkout(Request $request)
    {
        $nonceFromTheClient = $request->input('payment_method_nonce');

        $result = $this->gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return redirect()->route('checkout.success')->with('message', 'Transazione riuscita! ID: ' . $result->transaction->id);
        } else {
            return redirect()->route('checkout.error')->with('message', 'Transazione fallita: ' . $result->message);
        }
    }
}
