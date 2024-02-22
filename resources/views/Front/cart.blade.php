@extends('Front.layouts.front-layout' , ['title' => 'Cart'])
@section('content')
    @vite('resources/js/cart')
    <div class="untree_co-section before-footer-section">
        <div class="container">
                <div class="col-md-8 col-lg-12 pb-4">
                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            {{session('success')}}
                        </div>
                    @endif
                </div>
            <div class="row mb-5">

                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table" id="productTable">
                            @if(!(empty($cartProducts)))
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                            </thead>
                            @endif

                            <tbody>
                            @forelse($cartProducts as $product)
                                @if(!is_array($product)) @continue @endif
                                 <tr>
                                <td class="product-thumbnail">
                                    <img src="{{$product['imageUrl']}}" alt="Image" class="img-fluid">
                                </td>
                                <td class="product-name">
                                    <h2 class="h5 text-black">{{$product['title']}}</h2>
                                </td>
                                <td class="product-price">${{$product['price']}}</td>
                                <td>
                                    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-black decrease" data-id="{{$product['id']}}"  type="button">&minus;</button>
                                        </div>
                                        <input type="text" class="form-control text-center quantity-amount" value="{{$product['quantity'] ?? 1}}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-black increase" data-id="{{$product['id']}}"  type="button">&plus;</button>
                                        </div>
                                    </div>

                                </td>
                                <td >${{$product['price'] * $product['quantity']}}</td>
                                <td><a class="btn btn-black btn-sm remove"  data-id="{{$product['id']}}" >X</a></td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Products Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            @if(!empty($cartProducts))
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <a  href="{{route('products.index')}}" class="btn btn-outline-black btn-sm btn-block">Continue Shopping</a>
                        </div>
                    </div>
                    <form action="{{route('coupon.check')}}" method="post">
                            <div class="row">
                                      @csrf
                                    <div class="col-md-12">
                                        <label class="text-black h4" for="coupon">Coupon</label>
                                        <p>Enter your coupon code if you have one.</p>
                                    </div>
                                    <div class="col-md-8 mb-3 mb-md-0">
                                        <input type="text" name="code" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-black">Apply Coupon</button>
                                    </div>
                            </div>
                    </form>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">$230.00</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black" id="totalPrice">${{$cartProducts['totalPrice']}}</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('payment.checkout')}}" method="post">
                                        @csrf
                                         <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.html'">Proceed To Checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
@endsection
