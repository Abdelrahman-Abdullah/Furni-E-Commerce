<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function checkCoupon(CouponRequest $request)
    {
        try {
            $coupon = Coupon::firstWhere('code', $request->coupon);
            if (!$coupon || $coupon->validity === 'inactive'){
                return back()->with('error', 'Invalid Coupon or Expired');
            }
            $cart = session('cart' , []);
            $cart['totalPrice'] *=  ($coupon->value / 100);
            session(['cart' => $cart]);
            return back()->with('success', 'Coupon Applied Successfully');

        }catch (\Exception $e){
            //
        }

    }
}
