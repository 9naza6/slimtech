<div class="col-md-4 mt-4">
  <div class="card shadow">
    <img class="card-img-top" src="/storage/{{ $curso->imagen }}" alt="imagen curso">
    <div class="card-body">
      <div class="card-header bg-transparen">
      <h3 class="card-title">{{$curso->titulo}}</h3>
      </div>
      <div class="meta-curso d-flex justify-content-between">
        @php
        $fecha = $curso->created_at
        @endphp
        <p class="text-primary fecha font-weight-bold">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
          </svg>
          <fecha-curso fecha="{{$fecha}}"></fecha-curso>
        </p>
        <p> <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
          </svg> {{ count( $curso->likes ) }} Les gusto este curso</p>
      </div>
      <p> {{ Str::words( strip_tags( $curso->descripcion ), 15 ) }} </p>
      @if (isset($carrito))
      <p class="card-text"><i class="fas fa-cart-plus"></i> {{ $curso->pivot->quantity }} en tu carrito<strong> ${{ $curso->total }}</strong></p>
      <form class="d-inline" method="POST" action="{{ route('cursos.carritos.destroy', ['carrito' => $carrito->id, 'curso' => $curso->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-primary d-block btn-receta"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
          </svg>Remover del Carrito</button>
      </form>
      @else
      <div class="row">
      <div class="col-md-8">
      <form class="d-inline" method="POST" action="{{ route('cursos.carritos.store', ['curso' => $curso->id]) }}">
        @csrf
        <button type="submit" class="btn d-block btn-danger"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
          </svg>Agregar al carrito</button>
      </form>
      </div>
      
      <h4>$  {{ $curso->precio }}</h4>
      </div>
      @endif
      <!-- <a href="{{ route('cursos.show', ['curso' => $curso->id ]) }}" class="btn btn-primary d-block btn-receta"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icono" viewBox="0 0 20 20" fill="currentColor">
  <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
</svg>Ver Curso</a> -->


    </div>
  </div>
</div>