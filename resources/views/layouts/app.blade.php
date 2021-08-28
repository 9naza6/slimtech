<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('styles')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

    <div id="app" class="">
        @yield('navInicio')

        @yield('navproducts')

        @yield('hero')

        @yield('perfil')
        @yield('dashboard')

        <div class="bg-light">
            <div class="row">
                <div class="py-2 mt-4 col-12">
                    @yield('botones')
                </div>
                <main class="py-1 mt-1 col-12 bg-transparent">
                    <div class="container">
                        @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <ul>
                                @foreach (session()->get('success') as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <!-- @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif -->
                    <div class="py-2 mr-5">

                        @yield('content')
                    </div>
                </main>
                
            <div class="col-12">
            @yield('plus')
            @include('layouts.footer')
            </div>
            </div>
        </div>
    </div>
    @yield('scripts')
</body>

</html>