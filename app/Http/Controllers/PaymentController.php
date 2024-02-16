<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatusEnum;
use App\Models\Order;
use App\Services\PaymobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {

            $token = PaymobService::getAuthenticationToken();
            $order_id = PaymobService::orderRegistration([
                'auth_token' => $token,
                'delivery_needed' => 'false',
                'amount_cents' => 100 * (int)$request->amount,
                'currency' => 'EGP',
                'items' => [], // Adding Items Later
            ]);

            $payment_key = PaymobService::paymentKey([
                'auth_token' => $token,
                'amount_cents' => 100 * (int)$request->amount,
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
            Order::create(
                [
                    'user_id' => auth()->id(),
                    'order_id' => $order_id,
                    'total_amount' => $request->amount,
                    'transaction_status' => PaymentStatusEnum::PENDING,
                ]
            );
            return view('Front.payment-frame', [
                'payment_token' => $payment_key,
                'integration_id' => env('PAYMOB_INTEGRATION_ID'),

            ]);
    }
    public function checkout(Request $request): void
    {
        Log::error('callback',['obj'=>$request->obj]);
        $order_id = $request->obj['order']['id'];
        $transaction_id = $request->obj['id'];
        $order = Order::where('order_id', $order_id)->first();
        if ($request->obj['success']) {
            $order->update([
                'transaction_status' => PaymentStatusEnum::SUCCESS,
                'transaction_id' =>$transaction_id
            ]);
        }
        $order->update([
            'transaction_status' => PaymentStatusEnum::FAILED,
            'transaction_id' => $transaction_id
        ]);
    }
    public function success(Request $request)
    {
        return $request->all();
    }
}
