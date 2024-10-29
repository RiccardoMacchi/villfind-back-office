<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use Braintree\Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
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
        $sponsorship = Sponsorship::where('price', $request->price)->first();
        $clicked = false;
        $result = $this->gateway->transaction()->sale([
            'amount' => $request->price,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            session(['clicked' => $clicked]);
            return redirect()->route('admin.sponsorship.purchase', ['sponsorship' => $sponsorship]);
        } else {
            return redirect()->route('checkout.error')->with('message', 'Transazione fallita: ' . $result->message);
        }
    }

    public function showCheckout(Sponsorship $sponsorship)
    {
        $price = $sponsorship->price;
        $hours = $sponsorship->hours;
        $clicked = true;
        $clientToken = $this->token();
        // return view('checkout', compact('clientToken', 'price', 'hours', 'clicked'));
        session(['clientToken' => $clientToken, 'price' => $price, 'hours' => $hours, 'clicked' => $clicked]);
        return redirect()->route('admin.sponsorship.index');
    }
}
