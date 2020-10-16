<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" />

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/fontawesome.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <script src="{{ asset('js/clipboard.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    @hasSection('extra-header')
    @yield('extra-header')
    @endif
</head>
<body>
    <div id="app">
        
        @hasSection ('navbar')
        @yield('navbar')
        @endif
        <main>
            @hasSection('fcontent')
                @yield('fcontent')
            @endif
            @hasSection ('content')
            <div class="py-4">
                @yield('content')
            </div>
            @endif
        </main>
    </div>
    @hasSection ('extra-scripts')
    @yield('extra-scripts')
    @endif
</body>
</html>
