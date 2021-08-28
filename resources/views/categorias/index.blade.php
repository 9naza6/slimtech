@extends('ui.dashboard')
@section('sidebar')
<ul>
<li>
                    <a href="{{ route('perfilesshow.show', ['perfil' => Auth::user()->id ]) }}" class=""><span><i class="fas fa-users"></i></span><span>Comunidad</span></a>
                </li>
    <li>
        <a href="{{ route('cursos.index') }}"><span><i class="fas fa-home"></i></span><span>Panel Administrativo</span></a>
    </li>
    <li>
        <a href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id ]) }}"><span><i class="mr-3 fas fa-user"></i></span><span>Editar Perfil</span></a>
    </li>
    <li>
        <a href="{{ route('categorias.index') }}" class="active"><span><i class="mr-3 fab fa-opencart"></i></span><span>Productos</span></a>
    </li>
    <li>
        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <span><i class="mr-3 fas fa-door-closed"></i></span><span>Salir</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>
<!-- </div> -->
@endsection
@section('content')
<main>
    <div class="row">
        <div class="col">
            <a href="{{ route('cursos.create') }}" class="btn btn-danger mr-2 font-weight-bold" style="border-radius: 8px;"><i class="fas fa-plus-circle"></i>Agregar Producto</a>
        </div>
    </div>
    <div class="row">
    @foreach ($cursos as $curso)

    <div class="col-md-4 mt-4">
        <div class="card shadow">
            <img class="card-img-top" src="/storage/{{ $curso->imagen }}" alt="imagen curso">
            <div class="card-body">
                <h3 class="card-title">{{$curso->titulo}}</h3>
                <div class="meta-curso d-flex justify-content-between">
                    @php
                    $fecha = $curso->created_at
                    @endphp
                    <p class="text-primary fecha font-weight-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        <fecha-curso fecha="{{$fecha}}"></fecha-curso>
                    </p>
                    <p> <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                        </svg> {{ count( $curso->likes ) }} Les gusto este curso</p>
                </div>
                <p> {{ Str::words( strip_tags( $curso->descripcion ), 3 ) }} </p>
                <form class="d-inline" method="POST" action="{{ route('cursos.carritos.store', ['curso' => $curso->id]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <a type="submit" href="{{ route('cursos.edit', ['curso' => $curso->id]) }}" class="btn btn-info d-block btn-success"><i class="far fa-edit"></i>Editar</a>
                        </div>
                        <div class="col-md-6">
                            <h2>$ {{ $curso->precio }}</h2>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    
        
    </div>
</main>
@endsection