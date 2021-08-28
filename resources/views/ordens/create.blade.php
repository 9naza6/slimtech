@extends('ui.dashboard')
@section('sidebar')
<ul>
<li>
                    <a href="{{ route('perfilesshow.show', ['perfil' => Auth::user()->id ]) }}" class=""><span><i class="fas fa-users"></i></span><span>Comunidad</span></a>
                </li>
    <li>
    <li>
        <a href="{{ route('perfilesedit.edit', ['perfil' => Auth::user()->id ]) }}"><span><i class="mr-3 fas fa-user"></i></span><span>Editar Perfil</span></a>
    </li>
    <li>
        <a href="{{ route('carritos.index') }}" class="active"><span><i class="mr-3 fab fa-opencart"></i></span><span>Carrito</span></a>
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
<h2 class="text-center mb-5">Lista de Productos</h2>
<div class="text-right mb-3 container">
<form class="d-inline" method="POST" action="{{ route('ordens.store') }}">
    @csrf
    <button type="submit" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
        </svg>Confirmar Orden</button>
</form>
</div>


<div class="col-md-12 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-danger text-light">
            <tr>
                <th scole="col">Producto</th>
                <th scole="col">Precio</th>
                <th scole="col">Cantidad</th>
                <th scole="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carrito->cursos as $curso)
            <tr>

                <td>
                    <img src="/storage/{{ $curso->imagen }}" alt="" width="100">
                    {{$curso->titulo}}
                </td>
                <td>{{$curso->precio}}</td>
                <td>{{$curso->pivot->quantity }}</td>
                <td>
                    <!-- <eliminar-curso curso-id={{$curso->id}}>

                </eliminar-curso> -->
                    <strong>
                        ${{ $curso->total }}
                    </strong>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</main>
@endsection