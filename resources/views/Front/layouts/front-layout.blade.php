<!doctype html>
<html lang="en">

<!-- Start Head -->
@include('front.partials.head')
<!-- End Head -->
<body>

<!-- Start Header/Navigation -->
@include('front.partials.navbar')
<!-- End Header/Navigation -->

<!-- Start Hero Section -->
@include('front.partials.hero')
<!-- End Hero Section -->


@yield('content')


<!-- Start Footer Section -->
@include('front.partials.footer')
<!-- End Footer Section -->


<!-- Start Scripts -->
@include('front.partials.scripts')
<!-- End Scripts -->

</body>

</html>
