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
                            <i class="fas fa-user"></i> {{ __('Ver Perfil') }}
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
@section('botones')

<h1 class="text-center mb-4 text-light text-bold">{{$curso->titulo}}</h1>
@endsection
@section('content')

<article class="contenido-receta bg-white p-5 shadow m-2">
    <div class="row">
        <div class="col-md-6 imagen-curso">
            <img src="/storage/{{ $curso->imagen }}" alt="" class="w-100">
            

            <div class="justify-content-center row text-center">
                    <like-button curso-id="{{$curso->id}}" like="{{$like}}" likes="{{$likes}}"></like-button>
                </div>
        </div>
        <div class="receta-meta mt-5 col-md-5">
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <span class="font-weight-bold text-primary">Categoria:</span>
                        <a class="text-dark" href="{{ route('categorias.show', ['categoriaCurso' => $curso->categoria->id ]) }}">
                            {{$curso->categoria->nombre}}
                        </a>
                    </p>
                    <p>
                        <span class="font-weight-bold text-primary">Profesor:</span>
                        <a class="text-dark" href="{{ route('perfiles.show', ['perfil' => $curso->autor->id ]) }}">
                            {{$curso->autor->name}}
                        </a>
                    </p>
                    <p>
                        <span class="font-weight-bold text-primary">Fecha:</span>
                        @php
                        $fecha = $curso->created_at
                        @endphp

                        <fecha-curso fecha="{{$fecha}}"></fecha-curso>
                    </p>
                </div>
                <div class="justify-content-center row text-center col-md-6">
                    <form class="d-inline" method="POST" action="{{ route('cursos.carritos.store', ['curso' => $curso->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary d-block btn-info"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>$ {{ ( $curso->precio ) }} </button>
                            <a href="{{ route('inicion.index') }}" class="btn btn-light" type="button">Volver...</a>

                    </form>

                </div>
            </div>
            <div class="descripcion">
                <h2 class="my-3 text-primary">Descripcion</h2>
                {!! $curso->descripcion !!}
            </div>
        </div>
    </div>
</article>
@endsection
