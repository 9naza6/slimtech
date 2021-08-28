@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
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
@section('hero')
<div class="hero-categorias">
    <form class="container h-100" action="{{ route('buscar.show') }}">
        <div class="row h-100 align-items-center">
            <div class="col-md-6 texto-buscar">
                <h1 class="display-4 text-light"> <strong style="color:#FF0000">S</strong>lim<strong style="color:#FF0000">T</strong>ech cursos de ciencia y tecnología</h1>
                <p>Contribuyendo a la mejora de la vida mediante
                    el uso de Tecnologías de la Información</p>
                    
            <div class="col texto-buscar search-wrapper">
                <span><i class="fas fa-search"></i></span>
                <input type="search" name="buscar" id="" placeholder="Buscar curso" class="form-control">
                <!-- <input type="search" name="buscar" class="form-control" placeholder="Buscar curso"> -->
            </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')

<div class="container">
    <h2 class="titulo-categoria text-title mb-4 text-dark">Escoge un curso para aprender</h2>
    <h3 class="text-dark">Accede a los mejores Cursos de ciencia y tecnología.</h3>
    <div class="row">
        @foreach ($cursos as $curso)
        <div class="col-md-3 mt-4">
            <div class="card" id="card-products">
                <img src="/storage/{{ $curso->imagen }}" alt="imagen curso" class="card-img-top">
                <div class="card-body">
                    <h5>{{ Str::title( $curso->titulo ) }}</h5>
                    <p> {{ Str::words( strip_tags( $curso->descripcion ), 10 ) }} </p>
                    <p>Adquierelo por:</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <form class="d-inline" method="POST" action="{{ route('cursos.carritos.store', ['curso' => $curso->id]) }}">
                            @csrf
                            <button type="submit" class="btn btn-info d-block btn-success"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg>$ {{ ( $curso->precio ) }} </button>
                        </form>
                        <a href="{{ action('CursoShowController@show', ['curso' => $curso->id]) }}" class="btn" type="button">Ver más...</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
        <a href="/categoria/1" type="button" class="btn btn-outline-danger btn-lg">Ver mas cursos</a>
    </div>
</div>

<div class="container nuevas-recetas">

    <h2 class="titulo-categoria text-title mb-4 text-dark">Asesoria educativa</h2>
    <h3 class="text-dark">Permite que los mejores te guien.</h3>

    <div class="owl-carousel owl-theme">
        
        @foreach ($perfiles as $perfil)
        @if (optional($perfil->usuario)->isAdmin())
        <div class="container-cards" style="margin-top:50px;">
            <div class="row">
                <div class="card-sl">
                    <div class="card-image">
                        <img src="/storage/{{ $perfil->portada }}" />
                    </div>

                    <a class="card-action" href="#"><img src="/storage/{{ $perfil->imagen }}" alt="imagen perfil" class="rounded-circle"></a>
                    <div class="card-heading">
                        {{ Str::title( $perfil->usuario->name ) }}
                    </div>
                    <div class="card-text">
                        <!-- {{ Str::words( strip_tags( $perfil->biografia ), 5 ) }} -->
                    </div>
                    <div class="card-text text-center">
                        <ul class="social mb-0 list-inline mt-3">
                            <li class="list-inline-item"><a href="{{ $perfil->facebook }}" class="social-link"><i class="fab fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="{{ $perfil->twitter }}" class="social-link"><i class="fab fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="{{ $perfil->instagram }}" class="social-link"><i class="fab fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="{{ $perfil->linkedin }}" class="social-link"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                    <a href="{{ route('perfilesshow.show', $perfil) }}" class="card-button bg-danger"> Perfil</a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<div class="d-none d-sm-none d-md-block container-cards">

    <div class="container">
        <h2 class="titulo-categoria text-title text-dark" style="margin-top:50px;">Visita nuestra librería</h2>
        <h3 class="text-dark">Conoce los libros que tenemos para ti</h3>
        <div class="window">
            <div class="sp-panel-set">
                @foreach ($libros as $libro)
                <div class="sp-panel bg-white">
                    <img src="/storage/{{ $libro->imagen }}" alt="" class="img-fluid" style="height: 400px; width: 800px;">
                </div>
                @endforeach
            </div>

            <form class="" method="POST" action="{{ route('cursos.carritos.store', ['curso' => $curso->id]) }}">
                @csrf
                <div class="buttons">
                    <div class="left">
                        << </div>
                            <button type="submit" class="btn btn-outline-danger"><i class="fas fa-shopping-cart"></i></button>
                            <div class="right">>></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-cards">

    <div class="container">
        <h2 class="titulo-categoria text-title text-dark" style="margin-top:50px;">Tenemos mas que ofrecerte</h2>
        <h3 class="text-dark">Venta de productos lego, equipos de cómputo y accesorios</h3>
    </div>
    <div class="options">
        @foreach ($nuevas as $nueva)
        <div class="option" style="--optionBackground: url('/storage/{{ $nueva->imagen }}');">

            <div class="label">
                <div class="icon">
                    <a href="{{ route('categorias.show', ['categoriaCurso' => $nueva->categoria_id]) }}" class="icon"><i class="fas fa-shopping-cart"></i></a>
                    <!-- <form class="" method="POST" action="{{ route('cursos.carritos.store', ['curso' => $curso->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary d-block btn-danger"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>$ {{ ( $curso->precio ) }}
                        </button>
                    </form> -->
                </div>
                <div class="info">
                    <div class="main">{{ $nueva->titulo }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
@endsection