<footer>
    <nav class="navbar bg-secondary py-3">
        <div class="container-fluid">
            <div class="col-sm-12 text-center text-white">
                <i class="far fa-copyright"></i> {{ date("Y") }} Todos los derechos reservados
            </div>
            <div class="col-sm-12">
                <ul class="navbar-nav ml-auto flex-row">
                    <li class="nav-item ml-auto">
                        <a href="https://es-la.facebook.com/nicsescuela" class="text-white"><i class="fab fa-facebook-square"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="https://twitter.com/NicsEjecutores" class="text-white"><i class="fab fa-twitter-square"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.youtube.com" class="text-white"><i class="fab fa-youtube"></i></a>
                    </li>
                    <li class="nav-item">
                        <a href="https://pe.linkedin.com" class="text-white"><i class="fab fa-linkedin"></i></a>
                    </li>

                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item mr-auto">
                                <a href="{{ url('/home') }}" class="text-white" data-toggle="tooltip" data-placement="bottom" title="Inicio"><i class="fas fa-home"></i></a>
                            </li>
                        @else
                            <li class="nav-item mr-auto">
                                <a href="{{ route('login') }}" class="text-white" data-toggle="tooltip" data-placement="bottom" title="Ingresar"><i class="fas fa-home"></i></a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</footer>
