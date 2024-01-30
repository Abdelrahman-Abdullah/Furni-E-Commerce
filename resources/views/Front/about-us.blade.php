@extends('Front.layouts.front-layout' , ['title' => 'About Us'])
@section('content')

    @include('Front.partials.why-us')

    <!-- Start Team Section -->
    <div class="untree_co-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-lg-5 mx-auto text-center">
                    <h2 class="section-title">Our Team</h2>
                </div>
            </div>

            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="{{asset('front-assets/images')}}/person_1.jpg" class="img-fluid mb-5">
                    <h3 clas><a href="https://www.google.com/?q=Lawson Arnold"><span class="">Lawson</span> Arnold</a></h3>
                    <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
                        ocean.</p>
                    <p class="mb-0"><a href="https://www.google.com/?q=Lawson Arnold" class="more dark">Learn More <span
                                class="icon-arrow_forward"></span></a></p>
                </div>
                <!-- End Column 1 -->

                <!-- Start Column 2 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="{{asset('front-assets/images')}}/person_2.jpg" class="img-fluid mb-5">

                    <h3 clas><a href="https://www.google.com/?q=Jeremy Walker"><span class="">Jeremy</span> Walker</a></h3>
                    <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
                        ocean.</p>
                    <p class="mb-0"><a href="https://www.google.com/?q=Jeremy Walker" class="more dark">Learn More <span
                                class="icon-arrow_forward"></span></a></p>
                </div>
                <!-- End Column 2 -->

                <!-- Start Column 3 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="{{asset('front-assets/images')}}/person_3.jpg" class="img-fluid mb-5">
                    <h3 clas><a href="https://www.google.com/?q=Patrik White"><span class="">Patrik</span> White</a></h3>
                    <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
                        ocean.</p>
                    <p class="mb-0"><a href="https://www.google.com/?q=Patrik White" class="more dark">Learn More <span
                                class="icon-arrow_forward"></span></a></p>
                </div>
                <!-- End Column 3 -->

                <!-- Start Column 4 -->
                <div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
                    <img src="{{asset('front-assets/images')}}/person_4.jpg" class="img-fluid mb-5">

                    <h3 clas><a href="https://www.google.com/?q=Kathryn Ryan"><span class="">Kathryn</span> Ryan</a></h3>
                    <span class="d-block position mb-4">CEO, Founder, Atty.</span>
                    <p>Separated they live in.
                        Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language
                        ocean.</p>
                    <p class="mb-0"><a href="https://www.google.com/?q=Kathryn Ryan" class="more dark">Learn More <span
                                class="icon-arrow_forward"></span></a></p>
                </div>
                <!-- End Column 4 -->
            </div>
        </div>
    </div>
    <!-- End Team Section -->
    @include('Front.partials.testimonial')
@endsection
