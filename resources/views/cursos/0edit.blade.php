@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('botones')
<a href="{{ route('cursos.index')}}" class="btn btn-outline-primary mr-2 font-weight-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 icono" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
    </svg>Volver</a>
@endsection
@section('content')

<h2 class="text-center mb-5">Editar Curso: {{$curso->titulo}}</h2>
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <form method="POST" action="{{ route('cursos.update', ['curso' => $curso->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Titulo Curso</label>
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


            <div class="form-group">
                <label for="imagen">Elige la imagen</label>
                <input class="form-control @error('imagen') is-invalid @enderror" id="imagen" type="file" name="imagen">
                <div class="mt-4">
                    <p>Imagen Actual:</p>
                    <img src="/storage/{{$curso->imagen}}" alt="" style="width: 300px">
                </div>
                @error('imagen')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Agregar Curso">
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@endsection








