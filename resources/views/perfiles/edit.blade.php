@extends('ui.dashboard')
@section('sidebar')
<ul>
<li>
                    <a href="{{ route('perfilesshow.show', ['perfil' => Auth::user()->id ]) }}" class=""><span><i class="fas fa-users"></i></span><span>Comunidad</span></a>
                </li>
@if (optional(auth()->user())->isAdmin())
                <li>
                    <a href="{{ route('cursos.index') }}"><span><i class="fas fa-home"></i></span><span>Panel Administrativo</span></a>
                </li>
                <li>
                    <a href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id ]) }}" class="active"><span><i class="mr-3 fas fa-user"></i></span><span>Editar Perfil</span></a>
                </li>
                <li>
                    <a href="{{ route('categorias.index') }}"><span><i class="mr-3 fab fa-opencart"></i></span><span>Productos</span></a>
                </li>
                @else
                
                <li>
                    <a href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id ]) }}" class="active"><span><i class="mr-3 fas fa-user"></i></span><span>Editar Perfil</span></a>
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
@if (optional(auth()->user())->isAdmin())
            <form action="{{ route('perfiles.update', ['perfil' => $perfil->id ]) }}" method="POST" enctype="multipart/form-data">
            @csrf
                @method('PUT')
                <div style="background-image: url('/storage/{{ $perfil->portada }}'); height:20rem;
                            background-size: cover;
                            background-position: top center;">
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="">
                            <h2>Imagenes</h2>
                        </label>
                        <div class="form-group" id="toggler">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                <label class="btn btn-outline-primary" data-target="#payPalCollapse" data-toggle="collapse">
                                    <input type="radio" name="payment_platform" value="">
                                    <i class="fas fa-plus"></i>
                                </label>

                            </div>
                            <div id="payPalCollapse" class="collapse" data-parent="#toggler">
                                <div class="form-group col-md-6">
                                    <label for="imagen">Imagen de perfil</label>
                                    <input class="form-control @error('imagen') is-invalid @enderror" id="imagen" type="file" name="imagen">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="portada">Imagen de portada</label>
                                    <input class="form-control @error('portada') is-invalid @enderror" id="portada" type="file" name="portada">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-perfil">
                    <a class="" href="#">
                        @if($perfil->imagen)
                        <img src="/storage/{{$perfil->imagen}}" alt="imagen perfil" class="rounded-circle img-fluid">
                        @endif
                    </a>
                    <div class="form-group text-center mt-5">
                        <input type="submit" class="btn btn-lg btn-danger btn-round" value="Guardar">
                        <a href="{{ route('perfiles.update', ['perfil' => Auth::user()->id ]) }}" class="btn btn-lg btn-outline-info btn-round">Ver Perfil</a>
                    </div>
                    <div class="card-text-perfil text-center">
                        <ul class="social mb-0 list-inline mt-3">
                            <div class="form-group" id="toggler">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">


                                    <li class="list-inline-item" data-target="#facebook" data-toggle="collapse"><i class="fab fa-facebook-f social-link"></i></li>

                                    <li class="list-inline-item" data-target="#twitter" data-toggle="collapse"><i class="fab fa-twitter social-link"></i></li>
                                    <li class="list-inline-item" data-target="#instagram" data-toggle="collapse"><i class="fab fa-instagram social-link"></i></li>
                                    <li class="list-inline-item" data-target="#linkedin" data-toggle="collapse"><i class="fab fa-linkedin-in social-link"></i></li>

                                </div>
                                <div id="facebook" class="collapse" data-parent="#toggler">
                                    <div class="form-group">
                                        <label for="imagen">Tu Facebook</label>
                                        
                    <input type="text" name="facebook" class="form-control" id="facebook" placeholder="Facebook" value="{{ $perfil->facebook }}">
                                    </div>
                                </div>
                                <div id="twitter" class="collapse" data-parent="#toggler">
                                    <div class="form-group">
                                        <label for="imagen">Tu twitter</label>
                                        
                        <input type="text" name="twitter" class="form-control" id="twitter" placeholder="Twitter" value="{{ $perfil->twitter }}">
                                    </div>
                                </div>
                                <div id="instagram" class="collapse" data-parent="#toggler">
                                    <div class="form-group">
                                        <label for="imagen">Tu instagram</label>
                                        
                        <input type="text" name="instagram" class="form-control" id="instagram" placeholder="Instagram" value="{{ $perfil->instagram }}">
                                    </div>
                                </div>
                                <div id="linkedin" class="collapse" data-parent="#toggler">
                                    <div class="form-group">
                                        <label for="imagen">Tu linkedin</label>
                                        
                        <input type="text" name="linkedin" class="form-control" id="linkedin" placeholder="Linkedin" value="{{ $perfil->linkedin }}">
                                    </div>
                                </div>
                            </div>

                        </ul>
                    </div>
                </div>

                <h1 class="p-4 container">
                    {{ Str::title( $perfil->usuario->name ) }}
                    <div class="form-group col-md-6">
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror " id="nombre" placeholder="Tu Nombre" value="{{ $perfil->usuario->name }}">

                    </div>
                </h1>
                <div class="card-text-perfil container form-group row">
                    <div class="col-md-6">

                        {{ Str::words( strip_tags( $perfil->biografia ) ) }}
                    </div>
                    <input id="biografia" type="hidden" name="biografia" value="{{ $perfil->biografia }}">
                    <trix-editor class="form-control @error('biografia') is-invalid @enderror" input="biografia">
                    </trix-editor>
                    @error('biografia')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>



            </form>
            @else
            <form action="{{ route('perfilesupdate.update', ['perfil' => $perfil->id ]) }}" method="POST" enctype="multipart/form-data">
            @csrf
                @method('PUT')
                <div style="background-image: url('/storage/{{ $perfil->portada }}'); height:20rem;
                            background-size: cover;
                            background-position: top center;">
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="">
                            <h2>Imagenes</h2>
                        </label>
                        <div class="form-group" id="toggler">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">

                                <label class="btn btn-outline-primary" data-target="#payPalCollapse" data-toggle="collapse">
                                    <input type="radio" name="payment_platform" value="">
                                    <i class="fas fa-plus"></i>
                                </label>

                            </div>
                            <div id="payPalCollapse" class="collapse" data-parent="#toggler">
                                <div class="form-group col-md-6">
                                    <label for="imagen">Imagen de perfil</label>
                                    <input class="form-control @error('imagen') is-invalid @enderror" id="imagen" type="file" name="imagen">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="portada">Imagen de portada</label>
                                    <input class="form-control @error('portada') is-invalid @enderror" id="portada" type="file" name="portada">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-perfil">
                    <a class="" href="#">
                        @if($perfil->imagen)
                        <img src="/storage/{{$perfil->imagen}}" alt="imagen perfil" class="rounded-circle img-fluid">
                        @endif
                    </a>
                    <div class="form-group text-center mt-5">
                        <input type="submit" class="btn btn-lg btn-danger btn-round" value="Guardar">
                        <a href="{{ route('perfiles.update', ['perfil' => Auth::user()->id ]) }}" class="btn btn-lg btn-outline-info btn-round">Ver Perfil</a>
                    </div>
                    <div class="card-text-perfil text-center">
                        <ul class="social mb-0 list-inline mt-3">
                            <div class="form-group" id="toggler">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">


                                    <li class="list-inline-item" data-target="#facebook" data-toggle="collapse"><i class="fab fa-facebook-f social-link"></i></li>

                                    <li class="list-inline-item" data-target="#twitter" data-toggle="collapse"><i class="fab fa-twitter social-link"></i></li>
                                    <li class="list-inline-item" data-target="#instagram" data-toggle="collapse"><i class="fab fa-instagram social-link"></i></li>
                                    <li class="list-inline-item" data-target="#linkedin" data-toggle="collapse"><i class="fab fa-linkedin-in social-link"></i></li>

                                </div>
                                <div id="facebook" class="collapse" data-parent="#toggler">
                                    <div class="form-group">
                                        <label for="imagen">Tu Facebook</label>
                                        
                    <input type="text" name="facebook" class="form-control" id="facebook" placeholder="Facebook" value="{{ $perfil->facebook }}">
                                    </div>
                                </div>
                                <div id="twitter" class="collapse" data-parent="#toggler">
                                    <div class="form-group">
                                        <label for="imagen">Tu twitter</label>
                                        
                        <input type="text" name="twitter" class="form-control" id="twitter" placeholder="Twitter" value="{{ $perfil->twitter }}">
                                    </div>
                                </div>
                                <div id="instagram" class="collapse" data-parent="#toggler">
                                    <div class="form-group">
                                        <label for="imagen">Tu instagram</label>
                                        
                        <input type="text" name="instagram" class="form-control" id="instagram" placeholder="Instagram" value="{{ $perfil->instagram }}">
                                    </div>
                                </div>
                                <div id="linkedin" class="collapse" data-parent="#toggler">
                                    <div class="form-group">
                                        <label for="imagen">Tu linkedin</label>
                                        
                        <input type="text" name="linkedin" class="form-control" id="linkedin" placeholder="Linkedin" value="{{ $perfil->linkedin }}">
                                    </div>
                                </div>
                            </div>

                        </ul>
                    </div>
                </div>

                <h1 class="p-4 container">
                    {{ Str::title( $perfil->usuario->name ) }}
                    <div class="form-group col-md-6">
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror " id="nombre" placeholder="Tu Nombre" value="{{ $perfil->usuario->name }}">

                    </div>
                </h1>
                <div class="card-text-perfil container form-group row">
                    <div class="col-md-6">

                        {{ Str::words( strip_tags( $perfil->biografia ) ) }}
                    </div>
                    <input id="biografia" type="hidden" name="biografia" value="{{ $perfil->biografia }}">
                    <trix-editor class="form-control @error('biografia') is-invalid @enderror" input="biografia">
                    </trix-editor>
                    @error('biografia')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>



            </form>
            @endif


        </main>
@endsection