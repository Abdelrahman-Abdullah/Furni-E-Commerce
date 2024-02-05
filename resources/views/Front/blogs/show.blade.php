@extends('Front.layouts.front-layout', ['title' => $blog->title ??'Blog'])
@section('content')

    <div class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-8 mb-5 w-100">
                    <div class=" d-flex justify-content-evenly">
                        <span class="post-thumbnail mx-1   w-50"><img src="{{$blog->imageUrl}}" alt="Image" class="w-100"></span>
                        <div class="post-content-entry d-flex flex-column justify-content-center w-50 text-center ">
                            <h2>{{$blog->title}}</h2>
                            <p class="text-start p-2">
                                {{$blog->description}}
                            </p>
                            <div class="meta">
                                <span>by <a href="#">{{$blog->author->name}}</a></span> <span>{{$blog->createdDiffForHumans}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Front.partials.testimonial')
@endsection
