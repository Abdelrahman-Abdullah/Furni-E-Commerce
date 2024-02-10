<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">Furni<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item {{request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="{{request()->is('products') ? 'active' : '' }}">
                    <a class="nav-link " href="{{route('products.index')}}">Shop</a>
                </li>
                <li class="{{request()->is('about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('about')}}">About us</a>
                </li>
                <li class="{{request()->is('services') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('services')}}">Services</a>
                </li>
                <li class="{{request()->is('blogs') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('blogs.index')}}">Blog</a>
                </li>
                <li class="{{request()->is('contact') ? 'active' : '' }}">
                    <a class="nav-link" href={{route('contact.create')}}>Contact us</a>
                </li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                @auth
                    <li><a class="nav-link" href="{{route('cart.index')}}"><img src="{{asset("front-assets/images")}}/cart.svg"></a>
                    </li>
                    <li>
                        <form action="{{route('users.logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a class="nav-link" href="{{route('users.login')}}"><img
                                src="{{asset("front-assets/images")}}/user.svg"></a></li>
                @endauth
            </ul>
        </div>
    </div>

</nav>
