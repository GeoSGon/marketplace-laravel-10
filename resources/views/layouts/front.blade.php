<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/js/app.js'])
    @yield('stylesheets')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="margin-bottom: 2rem;">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Marketplace</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('/')) active @endif" aria-current="page" href="{{route('home')}}">Home</a>
                    </li>

                    @foreach($categories->take(5) as $category)
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('category*' . $category->slug)) active @endif" href="{{route('category.single', ['slug' => $category->slug])}}">
                                {{$category->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <ul class="navbar-nav me-8 mb-2 mb-lg-0">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>
                    @endguest

                    @auth
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('my-orders')) active @endif" href="{{route('user.orders')}}">Meus Pedidos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#" onclick="event.preventDefault(); 
                                                                                document.querySelector('form.logout').submit();">Sair</a> 

                        <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                        @csrf 
                        </form>
                    </li>
                    @endauth

                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('cart')) active @endif" href="{{route('cart.index')}}">
                            @if(session()->has('cart'))
                                <span class="badge bg-danger">{{array_sum(array_column(session()->get('cart'), 'amount'))}}</span>
                            @endif
                            <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>