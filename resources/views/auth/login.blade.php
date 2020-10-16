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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Da&display=swap" rel="stylesheet">
    <style>
        html,
    body {
        height: 100%;
        text-align: center;
    }
    
    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: rgba(0, 0, 0, 0.1);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
    
    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
        border: 1px solid #dcdcdc;
        border-radius: 20px 20px 20px 20px;
        -webkit-box-shadow: 5px 5px 15px 0px #000000;
        box-shadow: 5px 5px 15px 0px #000000;
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    .form-signin h1, p {
        color: #000 !important;
    }
    
    .form-signin .checkbox {
        font-weight: 400;
    }
    
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    
    .form-signin .form-control:focus {
        z-index: 2;
    }
    
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    
    .form-label-group {
        position: relative;
        margin-bottom: 1rem;
    }
    
    .feasibility-title {
        font-family: 'Baloo Da', cursive;
        color: #fff;
    }
    
    .form-bottom p {
        color: #fff;
    }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div id="app">
        <main>
            <form class="form-signin" method="POST" action="{{ route('login') }}">
              @csrf
              <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="" width="210" height="72">
              <h1 class="h5 mb-3 font-weight-normal feasibility-title">{{ config('app.name', 'Laravel') }}</h1>
              <div class="form-label-group">
                  <input id="email" type="email" class="form-control" name="email" required autocomplete="email" placeholder="E-mail" autofocus>
                  <div class="border-top my-3"></div>
                  <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" placeholder="Senha">
                  @foreach ($errors->all() as $error)
                      <div class="alert alert-danger" role="alert">
                          <strong>{{ $error }}</strong>
                      </div>
                  @endforeach
              </div>
              <button class="btn btn-lg btn-block" style="background-color: #4630AB; border-color: #4630AB; color: #FFFFFF" type="submit">Entrar</button>
              <div class="row form-bottom">
                  <div class="col">
                      <p class="mt-3 mb-3">v1.0 stable</p>
                  </div>
                  <div class="col">
                      <p class="mt-3 mb-3">&copy; 2020</p>
                  </div>
              </div>
          </form>
        </main>
    </div>
</body>
</html>
