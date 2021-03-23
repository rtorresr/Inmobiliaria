<header>
    <nav class="navbar bg-primary top p-0">
        <div class="container-fluid">
            <ul class="navbar-nav mr-auto flex-row flex-wrap informacion">
                <li class="nav-item mr-3">
                    <span class="nav-link text-white"><i class="fas fa-phone-alt mr-2"></i>{{ __('(01) 4124743 | 975388555') }}</span>
                </li>
                <li class="nav-item mr-3">
                    <span class="nav-link text-white"><i class="fas fa-envelope mr-2"></i>{{ __('nicsejecutores@gmail.com') }}</span>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto flex-row flex-nowrap">
                <li class="nav-item">
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
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="text-white" data-toggle="tooltip" data-placement="bottom" title="Inicio"><i class="fas fa-home"></i></a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="text-white" data-toggle="tooltip" data-placement="bottom" title="Ingresar"><i class="fas fa-home"></i></a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-sm navbar-light text-primary bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ config('app.logo', '/img/logo.png') }}" width="50" height="50" class="d-inline align-center mr-2" alt="Logo">
                <span class="title">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">{{ __('Inicio') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/#nosotros') }}" class="nav-link">{{ __('Nosotros') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/#propiedades') }}" class="nav-link">{{ __('Propiedades') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/#contactenos') }}" class="nav-link">{{ __('Contáctenos') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('web.buscador') }}" class="nav-link">{{ __('Buscador') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>
