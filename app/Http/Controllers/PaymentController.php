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
            'merchant_order_id' => '123456',
            'items' => [], // Adding Items Later
        ]);

        $payment_key = PaymobService::paymentKey([
            'auth_token' => $token,
            'amount_cents' => 100 * 5000,
            'currency' => 'EGP',
            'order_id' => $order_id,
            'billing_data' => [
                'apartment' => '803',
                'email' => '',
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
        ]);

        return view('Front.payment', [
            'payment_key' => $payment_key,
            'integration_id' => env('PAYMOB_INTEGRATION_ID'),

        ]);
    }
}
