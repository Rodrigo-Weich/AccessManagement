@extends('layouts.app')

@section('navbar')
    @component('components.navbar')
    @endcomponent
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card">
                <h5 class="card-header">{{ __('About this project') }}</h5>
                <div class="card-body">
                    <div class="text-center align-middle d-flex justify-content-center">
                        <div class="col-md-8">
                            <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="">
                            <p>{{ __('Developed to help your company grow!
                                The AM system was developed to simplify the dialogue with employees through an annotation system, password and event manager.
                                Its objective is to facilitate the day-to-day activities of employees and managers so that it is possible to make work more flexible and profitable.') }}</p>
                            <p class="card-text">{{ __('Developed by Thribbe LLC') }}</p>
                        </div>
                    </div>

                    <div class="row form-bottom text-center">
                        <div class="col">
                            <p class="mt-3 mb-3">v1.0 stable</p>
                        </div>
                        <div class="col">
                            <p class="mt-3 mb-3">&copy; 2020</p>
                        </div>
                    </div>

                    <span class="d-flex justify-content-center mt-2">
                        <a href="{{ route('home') }}" class="btn btn-primary">{{ __('Return to home page') }}</a>
                    </span>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection