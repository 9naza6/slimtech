@extends('ui.dashboard')@section('sidebar')
<ul>
<li>
                    <a href="{{ route('perfilesshow.show', ['perfil' => Auth::user()->id ]) }}" class=""><span><i class="fas fa-users"></i></span><span>Comunidad</span></a>
                </li>
    <li>
        <a href="{{ route('cursos.index') }}" class="active"><span><i class="fas fa-home"></i></span><span>Panel Administrativo</span></a>
    </li>
    <li>
        <a href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id ]) }}"><span><i class="mr-3 fas fa-user"></i></span><span>Editar Perfil</span></a>
    </li>
    <li>
        <a href="{{ route('categorias.index') }}"><span><i class="mr-3 fab fa-opencart"></i></span><span>Productos</span></a>
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
<main class="">
    <div class="cards">
        <div class="card-single">
            <div>
                <h1>{{ $totalUsers }}</h1>
                <span>Clientes</span>
            </div>
            <div>
                <span><i class="fas fa-users"></i></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{ $totalProducts }}</h1>
                <span>Proyectos</span>
            </div>
            <div>
                <span><i class="fas fa-book"></i></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{ $ordensPending }}</h1>
                <span>Ordenes</span>
            </div>
            <div>
                <span><i class="fas fa-cart-plus"></i></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{ $ordensPay }}</h1>
                <span>Pagados</span>
            </div>
            <div>
                <span><i class="fas fa-money-bill-alt"></i></span>
            </div>
        </div>
    </div>
    <div class="recent-grid">
        <div class="projects">
            <div class="card">
                <div class="card-header">
                    <h4>Productos Recientes</h4>
                    <a href="{{ route('categorias.index') }}" class="btn btn-danger" style="border-radius: 15px;">Ver más <span><i class="las la-arrow-right"></i></span></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table width="100%" class="table" id="td">
                            <thead>
                                <tr>
                                    <th scole="col">Titulo</th>
                                    <th scole="col">Categoría</th>
                                    <th scole="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $curso)
                                <tr>
                                    <td>{{$curso->titulo}}</td>
                                    <td>{{$curso->categoria->nombre}}</td>
                                    <td>
                                        <span class="">
                                            <a href="{{ route('cursos.edit', ['curso' => $curso->id]) }}" class="btn btn-info mr-1 d-block mb-2">Editar <span><i class="las la-arrow-right"></i></span></a>
                                        </span>
                                        <form action="{{ route('cursos.destroy', ['curso' => $curso->id ]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger d-block w-100 mb-2" value="Eliminar">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="customers">
            <div class="card">
                <div class="card-header">
                    <h4>Nuevos Usuarios</h4>
                </div>
                <div class="card-body">
                    @foreach ($top5Users as $user)
                    <div class="customer">
                        <div class="info">
                            @if ($user->perfil->imagen != null)
                            <img src="/storage/{{$user->perfil->imagen}}" alt="" width="40px" height="40px">
                            @else
                            <img src="{{ asset('/storage/default.gif') }}" alt="" width="40px" height="40px">
                            @endif
                            <div>
                                <h4>{{ $user->name }}</h4>
                                <small>CEO Excerpt</small>
                            </div>
                        </div>
                        <div class="contact">
                            <span class="las la-user-circle"></span>
                            <span class="las la-comment"></span>
                            <span class="las la-phone"></span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection