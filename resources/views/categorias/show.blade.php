@extends('layouts.app')
<nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <!-- {{ config('app.name', 'Laravel') }} -->
            <img src="{{ asset('/images/logo.png') }}" alt="imagen logo" width="130" height="60">
        </a>

        <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                @if (optional(auth()->user())->isAdmin())
                @else
                <a class="navbar-brand" href="{{ route('carritos.index') }}">

                    <i class="fas fa-cart-plus"></i>
                </a>
                @inject('carritoService','App\Services\CarritoService')
                <h4 class="text-light">({{ $carritoService->countProducts() }})</h4>
                @endif
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('perfilesshow.show', ['perfil' => Auth::user()->id ]) }}">
                            <i class="fas fa-user"></i> {{ __('Comunidad') }}
                        </a>
                        @if (optional(auth()->user())->isAdmin())
                        <a class="dropdown-item" href="{{ route('cursos.index') }}">
                            <i class="fas fa-address-card"></i>{{ 'Panel' }}
                        </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="mr-3 fas fa-door-closed"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@section('navproducts')
<nav class="navbar navbar-expand-md navbar-light categorias-bg">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categorias" aria-controls="categorias" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
            Categorias
        </button>
        <div class="collapse navbar-collapse " id="categorias">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav w-100 d-flex justify-content-between">
                @foreach ($categorias as $categoria)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categorias.show', ['categoriaCurso' => $categoria->id ]) }}">
                        {{ $categoria->nombre }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
@endsection
@section('content')
<div class="container">
    <h2 class="titulo-categoria text-uppercase mb-4 text-dark">Categoria: {{ $categoriaCurso->nombre }}</h2>
    <div class="row">
        @foreach ($cursos as $curso)
            @include('ui.curso')
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $cursos->links() }}
    </div>
</div>
@endsection