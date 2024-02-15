<?php

namespace App\Http\Controllers;

use App\Services\PaymobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $token = PaymobService::getAuthenticationToken();
        $order_id = PaymobService::orderRegistration([
            'auth_token' => $token,
            'delivery_needed' => 'false',
            'amount_cents' => 100 * 5000,
            'currency' => 'EGP',
            'items' => [], // Adding Items Later
        ]);

        $payment_key = PaymobService::paymentKey([
            'auth_token' => $token,
            'amount_cents' => 100 * 5000,
            'expiration' => 3600,
            'currency' => 'EGP',
            'order_id' => $order_id,
            'billing_data' => [
                'apartment' => '803',
                'email' => 'test@exampl.com',
                'floor' => '42',
                'first_name' => 'John',
                'street' => 'Ethan Hunt',
                'building' => '802',
                'phone_number' => '+201011122233',
                'shipping_method' => 'PKG',
                'postal_code' => '01898',
                'city' => 'Johannesburg',
                'country' => 'EG',
                'last_name' => 'Doe',
                'state' => 'NA',
                ],
            'integration_id' => env('PAYMOB_INTEGRATION_ID'),
        ]);

        return view('Front.payment-frame', [
            'payment_token' => $payment_key,
            'integration_id' => env('PAYMOB_INTEGRATION_ID'),

        ]);
    }
}
