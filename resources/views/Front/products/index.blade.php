@extends('Front.layouts.front-layout', ['title' => 'Shop'])
@section('content')
    @vite('resources/js/cart')

    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div x-data="showSuccessMessage" id="successMessage"  style="z-index: 1050; background: #0f5132; opacity: 0.9; display: none"
                 class="position-fixed bottom-50 start-50 translate-middle-x text-white text-center  col-6 rounded-3">
                <p x-show="display" class="m-0 px-2 p-2  ">
                    Product added successfully!
                </p>
            </div>
            <div class="row">
                @forelse($products as $product)
                    <!-- Start Column 1 -->
                    <div class="col-12 col-md-4 col-lg-3 mb-5 text-center">
                        <a class="product-item" href="{{route('products.show', $product->name)}}">
                            <img src="{{$product->imageUrl}}" class="img-fluid product-thumbnail" alt="">
                            <h3 class="product-title">{{$product->name}}</h3>
                            <strong class="product-price">${{$product->price}}</strong>
                        </a>
                        @auth
                        <span class=" bg-black rounded-circle p-2 addToCart"  data-id="{{$product->id}}">
                                <img src="{{asset('front-assets/images')}}/cross.svg" class="img-fluid" alt="{{$product->name}}">
                        </span>
                        @endauth
                    </div>
                @empty
                    <div class="col-12">
                        @error('error')
                        <h3 class="text-center">{{$message}}</h3>
                        @enderror
                    </div>
                @endforelse
                @if($products->isNotEmpty())
                    <div class="d-flex justify-content-center">
                        {{ $products->onEachSide(1)->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
