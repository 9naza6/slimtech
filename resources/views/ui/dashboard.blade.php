<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Styles -->
    <style>
        :root {
            --main-color: #d51212;
            --color-dark: #1D2231;
            --text-grey: #8390a2;
            --dk-gray-100: #F3F4F6;
            --dk-gray-200: #E5E7EB;
            --dk-gray-300: #D1D5DB;
            --dk-gray-400: #9CA3AF;
            --dk-gray-500: #6B7280;
            --dk-gray-600: #4B5563;
            --dk-gray-700: #374151;
            --dk-gray-800: #1F2937;
            --dk-gray-900: #111827;
            --dk-dark-bg: #313348;
            --dk-darker-bg: #2a2b3d;
            --navbar-bg-color: #6f6486;
            --sidebar-bg-color: #252636;
            --sidebar-width: 250px;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            list-style-type: none;
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <!-- <div class="hero"> -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2 class="text-center"><span><a href="{{ url('/') }}">
                        <img src="{{ asset('/images/logo.png') }}" alt="imagen logo" width="130" height="60">
                    </a></span></h2>
            <!-- <h2><span class="lab la-accusoft"></span><span>SlimTech</span></h2> -->
        </div>
        <div class="sidebar-menu">
            @yield('sidebar')
        </div>
    </div>
    <div class="main-content">
        <header class="header" id="header">
            <div class="col-md-4">
                <h4>
                    <label for="nav-toggle">
                        <span>
                            <i class="fas fa-bars"></i>
                        </span>
                    </label>
                    {{ Auth::user()->name }}
                </h4>
            </div>
            <form class="container h-100" action="{{ route('search.show') }}">

                <div class="search-wrapper col-md-10 bg-transparent">
                    <span><i class="fas fa-search"></i></span>

                    <input type="search" name="buscar" id="" placeholder="Buscar Perfil" class="form-control">

                </div>

            </form>
            <div class="user-wrapper">
                <a href="{{ route('perfiles.show', ['perfil' => Auth::user()->id ]) }}"><img src="/storage/{{Auth::user()->perfil->imagen}}" width="60px" height="60px" alt=""></a>

            </div>
        </header>
        @yield('content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script type="text/javascript">
        function mostrarInput() {
            document.getElementById('portadas').style.display = 'block';
        }
    </script>
</body>

</html>