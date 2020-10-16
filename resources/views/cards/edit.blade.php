@extends('layouts.app')

@section('extra-header')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header">{{ __('Edit existing') }}</div>

                <div class="card-body">

                    <form action="{{ route('user.cards.update', $data) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputname">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $data->name }}" autofocus>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputlogin">{{ __('Page login') }}</label>
                                <input type="text" class="form-control" id="inputlogin" name="login" value="{{ $data->login }}" autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputpassword">{{ __('Page password') }}</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="inputPassword" value="{{ $data->password }}" autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-placement="top" title="Mostrar senha" onclick="mostrarPassword()"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputurl">{{ __('Page URL') }}</label>
                                <input type="text" class="form-control" id="inputurl" name="url" value="{{ $data->url }}" autofocus>
                                <code>{{ __('The URL must start with http: // or https: // to function the target link') }}.</code>
                            </div>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <span class="float-right">
                            <a class="btn btn-danger" href="{{ route('user.cards.index') }}" role="button" data-toggle="tooltip"
                            data-placement="top" title="{{ __('Cancel and return') }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
                        </span>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script type='text/javascript'>
    function mostrarPassword() {
        if($("#inputPassword").is("input:text")) {
            $("#inputPassword").attr("type", "password");
        } else if($("#inputPassword").is("input:password")) {
            $("#inputPassword").attr("type", "text");
        }
    };
</script>
@endsection