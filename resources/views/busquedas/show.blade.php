@extends('ui.dashboard')
@section('sidebar')
<ul>
    
<li>
                    <a href="{{ route('perfilesshow.show', ['perfil' => Auth::user()->id ]) }}" class=""><span><i class="fas fa-users"></i></span><span>Comunidad</span></a>
                </li>
    <li>
        <a href="{{ route('perfilesedit.edit', ['perfil' => Auth::user()->id ]) }}"><span><i class="mr-3 fas fa-user"></i></span><span>Editar Perfil</span></a>
    </li>
    <li>
        <a href="{{ route('categorias.index') }}" class="active"><span><i class="mr-3 fab fa-opencart"></i></span><span>Carrito</span></a>
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
<div class="container">
    <h2 class="titulo-categoria text-uppercase mb-4">Resultados de la Búsqueda: {{ $busqueda }}</h2>
    <div class="row">
        @foreach ($cursos as $curso)
            @include('ui.curso')
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $cursos->links() }}
    </div>
</div>
</main>
@endsection