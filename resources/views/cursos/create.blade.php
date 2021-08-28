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
    <div class="card">
        <div class="card-header">
            <h2 class="text-center">Crear Nuevo Curso</h2>
        </div>
        <div class="card-body">
            <div class="row justify-content-center mt-5">
                <div class="col">
                    <form method="POST" action="{{ route('cursos.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="titulo">Titulo Curso</label>
                                    <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror " id="titulo" placeholder="Titulo Curso" value="{{ old('titulo') }}">
                                    @error('titulo')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="titulo">Estado</label>
                                            <select name="estado" class="custom-select" id="">
                                                <option value="" selected>--Seleccione-</option>
                                                <option value="available">Disponible</option>
                                                <option value="unavailable">No Disponible</option>
                                            </select>
                                            <!-- <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror " id="titulo" placeholder="Titulo Curso" value="{{ old('titulo') }}"> -->
                                            @error('titulo')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha">Fecha de Inicio</label>
                                            <input type="text" name="fecha" class="form-control @error('fecha') is-invalid @enderror " id="fecha" placeholder="Fecha Inicio" value="{{ old('fecha') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input type="number" min="1.00" step="0.01" name="precio" class="form-control @error('precio') is-invalid @enderror " id="precio" placeholder="Precio" value="{{ old('precio') }}">
                                            @error('precio')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="costo">Costo</label>
                                            <input type="text" name="costo" class="form-control @error('costo') is-invalid @enderror " id="costo" placeholder="Costo del Producto" value="{{ old('costo') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="existencia">Stock</label>
                                            <input type="number" min="0" name="existencia" class="form-control @error('existencia') is-invalid @enderror " id="existencia" placeholder="Existencia" value="{{ old('existencia') }}">
                                            @error('existencia')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="from-group">
                                            <label for="categoria">Categoria</label>
                                            <select name="categoria" class="form-control @error('categoria') is-invalid @enderror " id="categoria">
                                                <option value="">--Seleccione -</option>
                                                @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected': '' }}>{{$categoria->nombre}}</option>
                                                @endforeach
                                            </select>
                                            @error('categoria')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="container">

                                        <div class="form-group">
                                            <label for="imagen">Elige la imagen</label>
                                            <input class="form-control @error('imagen') is-invalid @enderror" id="imagen" type="file" name="imagen" value="{{ old('descripcion') }}">
                                            @error('imagen')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="container">
                                        <div class="form-row text-center">
                                            <div class="col-12">
                                                
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-info" value="Agregar Curso">
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-7">
                                <label for="descripcion">Descripción</label>
                                <input id="descripcion" type="hidden" name="descripcion" value="{{ old('descripcion') }}">
                                <trix-editor class="form-control @error('descripcion') is-invalid @enderror" input="descripcion">
                                </trix-editor>
                                @error('descripcion')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection