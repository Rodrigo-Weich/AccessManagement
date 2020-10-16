<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/fontawesome.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #e1e1e1;
        }
    </style>

</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row align-items-center justify-content-center" style="height:100vh;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 text-center">
                            <p><i class="fa fa-exclamation-triangle fa-5x text-warning"></i><br/>Código: <strong>403</strong></p>
                        </div>
                        <div class="col-md-10">
                            <h3>OPPSSS!!!! Desculpe...</h3>
                            <p>Parece que você não tem a permissão necessária para acessar esse recurso do sistema.<br/>Por favor, solicite acesso através de um administrador e tente novamente!.</p>
                            <a class="btn btn-danger" href="{{ route('home') }}">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>