
@extends('ui.dashboard')
@section('sidebar')
<ul>
    
<li>
                    <a href="{{ route('perfilesshow.show', ['perfil' => Auth::user()->id ]) }}" class="active"><span><i class="fas fa-users"></i></span><span>Comunidad</span></a>
                </li>
@if (optional(auth()->user())->isAdmin())
                <li>
                    <a href="{{ route('cursos.index') }}"><span><i class="fas fa-home"></i></span><span>Panel Administrativo</span></a>
                </li>

                <li>
                    <a href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id ]) }}" class=""><span><i class="mr-3 fas fa-user"></i></span><span>Editar Perfil</span></a>
                </li>
                <li>
                    <a href="{{ route('categorias.index') }}"><span><i class="mr-3 fab fa-opencart"></i></span><span>Productos</span></a>
                </li>
                
                @else
                <li>
                    <a href="{{ route('perfilesedit.edit', ['perfil' => Auth::user()->id ]) }}" class=""><span><i class="mr-3 fas fa-user"></i></span><span>Editar Perfil</span></a>
                </li>
                <li>
                    <a href="{{ route('carritos.index') }}"><span><i class="mr-3 fab fa-opencart"></i></span><span>Carrito</span></a>
                </li>
                @endif
                
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
<div class="container">
    <h2 class="titulo-categoria text-uppercase mb-4">Resultados de la Búsqueda: {{ $busqueda }}</h2>
    <div class="row">
        @foreach ($perfiles as $curso)
        <div class="col-md-4 mt-4">
            <div class="card shadow">
                <img class="card-img-top" src="/storage/{{$curso->perfil->imagen}}" alt="imagen curso">
                <div class="card-body">
                        <h3 class="card-title">{{$curso->name}}</h3>
                    <p> {{ Str::words( strip_tags( $curso->perfil->biografia ), 15 ) }} </p>
                    <a href="{{ route('perfilesshow.show', $curso) }}" class="card-button bg-danger"> Perfil</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

        </main>
@endsection
