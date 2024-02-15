<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymobService
{
    public static function getAuthenticationToken()
    {
        $response = Http::post('https://accept.paymob.com/api/auth/tokens',[
            'api_key' => env('PAYMOB_API_KEY')
        ]);
        return $response->json()['token'];
    }
    public static function orderRegistration($body)
    {
        $response = Http::post('https://accept.paymob.com/api/ecommerce/orders',[$body]);
        return $response->json()['id'];
    }
    public static function paymentKey($order_id)
    {
        $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys',[]);
        return $response->json()['token'];
    }
}
