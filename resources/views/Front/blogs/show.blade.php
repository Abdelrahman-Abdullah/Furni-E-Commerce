@extends('Front.layouts.front-layout', ['title' => $blog_name ??'Blog'])
@section('content')

    <div class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-8 mb-5 w-100">
                    <div class=" d-flex justify-content-evenly">
                        <a href="#" class="post-thumbnail mx-1   w-50"><img src="images/post-1.jpg" alt="Image" class="w-100"></a>
                        <div class="post-content-entry d-flex flex-column justify-content-center w-50 text-center ">
                            <h2>First Time Home Owner Ideas</h2>
                            <p class="text-start p-2">
                                fjdsfbdsnkfhdsfhkkdshfdsjkadk fhdsjfhvdsh fdsjfhsdhflsdlv
                                fjdsfbdsnkfhdsfhkkdshfdsjkadk fhdsjfhvdsh fdsjfhsdhflsdlv
                                fjdsfbdsnkfhdsfhkkdshfdsjkadk fhdsjfhvdsh fdsjfhsdhflsdlv
                                fjdsfbdsnkfhdsfhkkdshfdsjkadk fhdsjfhvdsh fdsjfhsdhflsdlv
                                fjdsfbdsnkfhdsfhkkdshfdsjkadk fhdsjfhvdsh fdsjfhsdhflsdlv
                                fjdsfbdsnkfhdsfhkkdshfdsjkadk fhdsjfhvdsh fdsjfhsdhflsdlv
                                fjdsfbdsnkfhdsfhkkdshfdsjkadk fhdsjfhvdsh fdsjfhsdhflsdlv
                                fjdsfbdsnkfhdsfhkkdshfdsjkadk fhdsjfhvdsh fdsjfhsdhflsdlv
                            </p>
                            <div class="meta">
                                <span>by <a href="#">Kristin Watson</a></span> <span>on Dec 19, 2021</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Front.partials.testimonial')
@endsection
