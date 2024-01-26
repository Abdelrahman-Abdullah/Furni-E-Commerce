@extends('Front.layouts.front-layout' , ['title'=>$product->name ?? 'Product Page'])
@section('content')
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                <!-- Start Column 1 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <img src="{{asset('front-assets/images')}}/product-3.png" class="img-fluid product-thumbnail">
                </div>
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>	<h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>	<h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>	<h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>
                </div>
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>	<h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>	<h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>	<h3 class="product-title">Nordic Chair</h3>
                    <strong class="product-price">$50.00</strong>
                </div>
                <!-- End Column 1 -->
            </div>
        </div>
    </div>
@endsection
