<div class="my-5">
    <footer class="bg-primary text-center text-lg-start text-white">
        <div class="container p-4">
            <div class="row my-4">
                <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                    <div class="rounded-circle bg-primary shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 150px; height: 150px;">
                        <img src="{{ asset('/images/logo.png') }}" height="70" alt="" loading="lazy" />
                    </div>
                    <p class="text-center">Siguenos en nuestras redes sociales</p>
                    <ul class="list-unstyled d-flex flex-row justify-content-center">
                        <li>
                            <a class="text-white px-2" href="https://www.facebook.com/SlimtechSAS/">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                        </li>
                        <li>
                            <a class="text-white px-2" href="#!">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a class="text-white ps-2" href="#!">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Productos</h5>
                    <ul class="list-unstyled">
                    @foreach ($categorias as $categoria)
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('categorias.show', ['categoriaCurso' => $categoria->id ]) }}">
                    <i class="fas fa-vial"></i>{{ $categoria->nombre }}
                    </a>
                </li>
                @endforeach
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Contacto</h5>

                    <ul class="list-unstyled">
                        <li>
                            <p><i class="fas fa-map-marker-alt pe-2"></i>Calle Galeana #4 colonia centro.</p>
                        </li>
                        <li>
                            <p><i class="fas fa-phone pe-2"></i>2361020931</p>
                        </li>
                        <li>
                            <p><i class="fas fa-envelope pe-2 mb-0"></i>contact@example.com</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2020 SlimTech
        </div>
    </footer>
</div>