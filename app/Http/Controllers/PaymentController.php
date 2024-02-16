<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatusEnum;
use App\Models\Order;
use App\Services\PaymobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
            $cartInformation = PaymobService::getCartInformation();
            $token = PaymobService::getAuthenticationToken();
            $order_id = PaymobService::orderRegistration([
                'auth_token' => $token,
                'delivery_needed' => 'false',
                'currency' => 'EGP',
                'items' => $cartInformation['items'], // Adding Items Later
                'amount_cents' => $cartInformation['totalPrice']  ,
            ]);

            $payment_key = PaymobService::paymentKey([
                'auth_token' => $token,
                'amount_cents' => $cartInformation['totalPrice'],
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
                    'total_amount' => $cartInformation['totalPrice'] / 100,
                    'transaction_status' => PaymentStatusEnum::PENDING,
                ]
            );
           return Redirect::away('https://accept.paymob.com/api/acceptance/iframes/781592?payment_token='.$payment_key);
    }
    public function checkout(Request $request):void
    {

        $order_id = $request->obj['order']['id'];
        $transaction_id = $request->obj['id'];
        $order = Order::where('order_id', $order_id)->first();
        if ($request->obj['success']) {
            $order->update([
                'transaction_status' => PaymentStatusEnum::SUCCESS,
                'transaction_id' =>$transaction_id
            ]);
            return;
        }
        $order->update([
            'transaction_status' => PaymentStatusEnum::FAILED,
            'transaction_id' => $transaction_id
        ]);
    }
    public function success()
    {
        return redirect()->route('cart.index')->with('success', 'Payment was successful');
    }
}
