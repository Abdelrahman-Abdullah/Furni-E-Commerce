@extends('Front.layouts.front-layout' , ['title'=>$product->name ?? 'Product Page'])
@section('content')
    @error('error')
    <div class="alert alert-danger text-center m-5 ">{{$message}}</div>
    @else
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                <!-- Start Column 1 -->
                <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <img src="{{$product->image_url}}" class="img-fluid product-thumbnail">
                </div>
                <div class="col-12 col-md-4 col-lg-3 mb-5 d-flex justify-content-between align-items-start w-75">
                    <div class="w-50">
                        <h3 class="product-title">Name</h3>
                        <strong class="product-price">{{$product->name}}</strong>
                        <h3 class="product-title">Price</h3>
                        <strong class="product-price">${{$product->price}}</strong>
                    </div>
                    <div>
                        <h3 class="product-title">Category</h3>
                        <strong class="product-price">{{$product->category->name}}</strong>
                        <h3 class="product-title">Desc.</h3>
                        <strong class="product-price">{{$product->description}}</strong>
                    </div>
                </div>
                <!-- End Column 1 -->
            </div>
        </div>
    </div>
    @enderror
@endsection
