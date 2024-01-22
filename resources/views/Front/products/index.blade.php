@extends('Front.layouts.front-layout', ['title' => 'Shop'])
@section('content')
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                @forelse($products as $product)
                    <!-- Start Column 1 -->
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
{{--                        TODO: Add href to the product page--}}
                        <a class="product-item" href="#">
                            <img src="{{$product->imageUrl}}" class="img-fluid product-thumbnail" alt="">
                            <h3 class="product-title">{{$product->name}}</h3>
                            <strong class="product-price">${{$product->price}}</strong>

                            <span class="icon-cross">
                                    <img src="{{asset('front-assets/images')}}/cross.svg" class="img-fluid" alt="{{$product->name}}">
                            </span>
                        </a>
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
