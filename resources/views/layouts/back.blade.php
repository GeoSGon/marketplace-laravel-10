<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('build/assets/')}}">
    @vite(['resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 2rem;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Marketplace</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @auth
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/orders*')) active @endif" aria-current="page" href="{{route('admin.orders.my')}}">Meus Pedidos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/stores*')) active @endif" aria-current="page" href="{{route('admin.stores.index')}}">Loja</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/products*')) active @endif" href="{{route('admin.products.index')}}">Produtos</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('admin/categories*')) active @endif" href="{{route('admin.categories.index')}}">Categorias</a>
                </li>
            </ul>
            
        <div class="d-flex mx-2">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="{{route('admin.notifications.index')}}" class="nav-link">
                        <span class="badge bg-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                        <i class="fa fa-bell"></i>
                    </a>
                </li>

                <li class="nav-link">
                    <spam class="nav-link>">{{auth()->user()->name}}</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#" onclick="event.preventDefault(); 
                                                                             document.querySelector('form.logout').submit();">Sair</a> 

                    <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                     @csrf 
                    </form>
                </li>
            </ul>
        </div>
        @endauth

    </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>