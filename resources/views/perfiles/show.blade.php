@extends('ui.dashboard')
@section('sidebar')
<ul>
    
<li>
                    <a href="{{ route('perfilesshow.show', $perfil) }}" class="active"><span><i class="fas fa-users"></i></span><span>Comunidad</span></a>
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
<div style="background-image: url('/storage/{{ $perfil->portada }}'); height:20rem;
    background-size: cover;
    background-position: top center;">
</div>
<a class="card-perfil" href="#">
                @if($perfil->imagen)
                <img src="/storage/{{$perfil->imagen}}" alt="imagen perfil" class="rounded-circle img-fluid">
                @endif
            </a>
            <h1 class="p-4 container"><strong>{{ Str::title( $perfil->usuario->name ) }}</strong></h1>
            <div class="card-text-perfil container">
                {{ Str::words( strip_tags( $perfil->biografia ) ) }}
            </div>
            <div class="card-text-perfil text-center">
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item"><a href="{{ $perfil->facebook }}" class="social-link text-info"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="{{ $perfil->twitter }}" class="social-link text-info"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="{{ $perfil->instagram }}" class="social-link text-info"><i class="fab fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="{{ $perfil->linkedin }}" class="social-link text-info"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
            </div>

<h2 class="text-center my-5">Productos de: {{$perfil->usuario->name }}</h2>
<div class="container">
    <div class="row mx-auto bg-white p-4">
        @if(count($cursos) > 0)

        @foreach($cursos as $curso)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="/storage/{{$curso->imagen}}" class="card-img-top" alt="imagen curso">
                <div class="card-body">
                    <h3>{{$curso->titulo}}</h3>
                    <a href="{{ route('cursos.show', ['curso' => $curso->id]) }}" class="btn btn-info d-block mt-4 text-uppercase font-weight-bold">Ver Curso</a>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p class="text-center col-12 w-100">No hay productos aún...</p>
        @endif
    </div>
    <div class="d-flex justify-content-center mt-2">
        {{$cursos->links()}}
    </div>
</div>

        </main>
@endsection
