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
                    <a href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id ]) }}"><span><i class="mr-3 fas fa-user"></i></span><span>Perfil</span></a>
                </li>
                <li>
                    <a href="{{ route('categorias.index') }}"  class="active"><span><i class="mr-3 fab fa-opencart"></i></span><span>Productos</span></a>
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
            <a href="{{ route('cursos.index')}}" class="btn btn-light mr-2 font-weight-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 icono" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>Volver</a>
            <div class="row">
                <form method="POST" action="{{ route('cursos.update', ['curso' => $curso->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-8 mt-4 container">
                        <div class="card shadow">
                            <img class="card-img-top" src="/storage/{{ $curso->imagen }}" alt="imagen curso">
                            <div class="row">
                            <div class="form-group col-md-8 m-2">
                                <!-- <label for="imagen">Elige la imagen</label> -->
                                <input class="form-contro" id="imagen" type="file" name="imagen">
                                @error('imagen')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3 m-2">
                                <input type="submit" class="btn btn-info" value="Guardar">
                            </div>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">Titulo</h3>
                                <div class="form-group">
                                    <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror " id="titulo" placeholder="Titulo Curso" value="{{ $curso->titulo }}">
                                    @error('titulo')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="categoria">Categoria</label>
                                            <select name="categoria" class="form-control @error('categoria') is-invalid @enderror " id="categoria">
                                                <option value="">--Seleccione -</option>
                                                @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}" {{ $curso->categoria_id == $categoria->id ? 'selected': '' }}>{{$categoria->nombre}}</option>
                                                @endforeach
                                            </select>
                                            @error('categoria')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="from-group">
                                            <label for="estado">Estado</label>
                                            <select name="estado" class="form-control @error('estado') is-invalid @enderror " id="estado">
                                                <option value="">--Seleccione -</option>
                                                <option value="available">Disponible</option>
                                                <option value="unavailable">No Disponible</option>
                                            </select>
                                            @error('categoria')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <input id="descripcion" type="hidden" name="descripcion" value="{{ $curso->descripcion }}">
                                    <trix-editor class="form-control @error('descripcion') is-invalid @enderror" input="descripcion">
                                    </trix-editor>
                                    @error('descripcion')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="col-md-4">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8">

                        </div>
                    </div>
                </div>
            </div>

        </main>
@endsection