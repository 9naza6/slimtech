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
<h1 class="text-center">Editar Mi Perfil</h1>
<div class="row justify-content-center mt-5">
    <div class="col-md-7 bg-white p-3">
        <form action="{{ route('perfiles.update', ['perfil' => $perfil->id ]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror " id="nombre" placeholder="Tu Nombre" value="{{ $perfil->usuario->name }}">
                @error('nombre')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <ul class="social mb-0 list-inline mt-3 form-group">
                        
                    
                    
                    <li class="list-inline-item"><a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a></li>
                        
                    <input type="text" name="facebook" class="form-control" id="facebook" placeholder="Facebook" value="{{ $perfil->facebook }}">
                    
                    
                    
                    </ul>
                    <ul class="social mb-0 list-inline mt-3">
                        <li class="list-inline-item"><a href="#" class="social-link"><i class="fab fa-twitter"></i></a></li>
                        <input type="text" name="twitter" class="form-control" id="twitter" placeholder="Twitter" value="{{ $perfil->twitter }}">
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="social mb-0 list-inline mt-3">
                        <li class="list-inline-item"><a href="#" class="social-link"><i class="fab fa-instagram"></i></a></li>
                        <input type="text" name="instagram" class="form-control" id="instagram" placeholder="Instagram" value="{{ $perfil->instagram }}">
                    </ul>
                    <ul class="social mb-0 list-inline mt-3">
                        <li class="list-inline-item"><a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a></li>
                        <input type="text" name="linkedin" class="form-control" id="linkedin" placeholder="Linkedin" value="{{ $perfil->linkedin }}">
                    </ul>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="biografia">Biografia</label>
                <input id="biografia" type="hidden" name="biografia" value="{{ $perfil->biografia }}">
                <trix-editor class="form-control @error('biografia') is-invalid @enderror" input="biografia">
                </trix-editor>
                @error('biografia')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>



            <div class="form-group">
                <label for="imagen">Imagen de perfil</label>
                <input class="form-control @error('imagen') is-invalid @enderror" id="imagen" type="file" name="imagen">
            </div>

            <div class="form-group">
                <label for="portada">Imagen de portada</label>
                <input class="form-control @error('portada') is-invalid @enderror" id="portada" type="file" name="portada">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
            </div>

        </form>
    </div>
    <div class="col-md-5 bg-white">
        <div class="container-cards" style="margin-top:50px;">
            <div class="row">
                <div class="card-sl">
                    <div class="card-image">
                        <img src="/storage/{{$perfil->portada}}" alt="" style="width: 300px">
                    </div>

                    <a class="card-action" href="#"><img src="/storage/{{ $perfil->imagen }}" alt="imagen perfil" class="rounded-circle img-fluid"></a>
                    <div class="card-heading">
                        {{ Str::title( $perfil->usuario->name ) }}
                    </div>
                    <div class="card-text">
                        <!-- {{ Str::words( strip_tags( $perfil->biografia ), 5 ) }} -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection