<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Scan impex">

    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('front/images/kopf.jpg')}} "></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item @if(Route::currentRouteName()=='home') active @endif">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li  class="nav-item @if(Route::currentRouteName()=='shop') active @endif">
                    <a class="nav-link" href="{{route('shop')}}">Shop</a>
                </li>

                <li  class="nav-item @if(Route::currentRouteName()=='contact') active @endif">
                        <a class="nav-link" href="{{route('contact')}}">Contact us</a>
                </li>
            </ul>
            @auth()
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="{{route('profile')}}"><img src="{{ asset('front/images/user.svg') }} "></a></li>
                    <li><a class="nav-link" href="{{route('cart')}}"><img src="{{ asset('front/images/cart.svg') }} "></a></li>


                </ul>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <li  class="nav-link"><button type="submit" class="btn"><i class="fas fa-sign-out-alt"></i></button></li>

                </form>
            @else

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link sign-in " href="{{route('login')}}">Sign in</a></li>
                    <li><a class="nav-link sign-up " href="{{route('register')}}">Sign up</a></li>
                </ul>

            @endauth

        </div>
    </div>

</nav>
