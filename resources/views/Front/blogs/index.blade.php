@extends('Front.layouts.front-layout',['title'=>'Our Blog'])
@section('content')
    <!-- Start Blog Section -->
        <div class="blog-section">
            <div class="container">
                <div class="row">
                    @forelse($blogs as $blog)
                    <div class="col-12 col-sm-6 col-md-4 mb-5">
                        <div class="post-entry">
                            <a href="{{route('blogs.show',$blog->slug)}}" class="post-thumbnail"><img src="{{$blog->imageUrl}}" alt="Image" class="img-fluid"></a>
                            <div class="post-content-entry">
                                <h3><a href="#">{{$blog->title}}</a></h3>
                                <div class="meta">
                                    <span>by <a href="#">{{$blog->author->name}}</a></span> <span>on <a href="#">{{$blog->createdDiffForHumans}}</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                        @empty
                        <div class="col-12 text-center">
                            <h1>No Blogs Found Yet</h1>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- End Blog Section -->
    @include('Front.partials.testimonial')
@endsection
