@extends('front.layouts.front-layout', ['title' => "Modern Interior Design Studio"])
@section('content')
    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">
                    <!-- Start Column 1 -->
                    <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                        <h2 class="mb-4 section-title">Crafted with excellent material.</h2>
                        <p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                            vulputate velit imperdiet dolor tempor tristique. </p>
                        <p><a href="{{route('products.index')}}" class="btn">Explore</a></p>
                    </div>
                    <!-- End Column 1 -->
                @foreach($recentProducts as $product)
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        {{--    TODO:: Add Link To Cart--}}
                        <a class="product-item" href="cart.html">
                            <img src="{{$product->imageUrl}}" class="img-fluid product-thumbnail">
                            <h3 class="product-title">{{$product->name}}</h3>
                            <strong class="product-price">${{$product->price}}</strong>

                            <span class="icon-cross">
                                    <img src="{{asset("front-assets/images")}}/cross.svg" class="img-fluid">
                                </span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
    @include('front.partials.why-us')
    <!-- End Why Choose Us Section -->

    <!-- Start We Help Section -->
    @include('front.partials.help')
    <!-- End We Help Section -->

    <!-- Start Popular Product -->
    <div class="popular-product">
        <div class="container">
            <div class="row">
                @foreach($recentProducts as $product)
                    <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="product-item-sm d-flex">
                            <div class="thumbnail">
                                <img src="{{$product->imageUrl}}" alt="Image" class="img-fluid">
                            </div>
                            <div class="pt-3">
                                <h3>{{$product->name}}</h3>
                                <p>{{$product->description}}</p>
                                <p><a href="#">Read More</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Popular Product -->

    <!-- Start Testimonial Slider -->
    @include('front.partials.testimonial')
    <!-- End Testimonial Slider -->

    <!-- Start Blog Section -->
    <div class="blog-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h2 class="section-title">Recent Blog</h2>
                </div>
                <div class="col-md-6 text-start text-md-end">
                    {{--TODO:: Add Link To All Blogs--}}
                    <a href="{{route('blogs.index')}}" class="more">View All Posts</a>
                </div>
            </div>

            <div class="row">
                @foreach($recentBlogs as $blog)
                        {{--TODO:: Add Links To Blog--}}
                    <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                        <div class="post-entry">
                            <a href="#" class="post-thumbnail"><img src="{{$blog->imageUrl}}"
                                                                    alt="Image" class="img-fluid"></a>
                            <div class="post-content-entry">
                                <h3><a href="#">{{$blog->title}}</a></h3>
                                <div class="meta">
                                    <span>by <a href="#">{{$blog->author->name}}</a></span> <span>on <a
                                            href="#">{{$blog->createdDiffForHumans}}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- End Blog Section -->
@endsection





