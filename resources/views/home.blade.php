@extends('layouts.app')

@section('extra-header')

@endsection

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card-deck col-md-10">
            
            <div class="card mb-4 box-shadow" style="border-radius: 0.65rem !important; background-color: #F8F9FA">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ __('Notes') }}</h3>
                    <div style="height: 250px">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
            <div class="card mb-4 box-shadow" style="border-radius: 0.65rem !important; background-color: #F8F9FA">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ __('Cards') }}</h3>
                    <div style="height: 250px">
                        {!! $chart2->container() !!}
                    </div>
                </div>
            </div>
            <div class="card mb-4 box-shadow" style="border-radius: 0.65rem !important; background-color: #F8F9FA">
                <div class="card-body">
                    <h3 class="card-title text-center">{{ __('Card Groups') }}</h3>
                    <div style="height: 250px">
                        {!! $chart3->container() !!}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex align-items-center p-3 my-3 text-white-50 rounded box-shadow-lg" style="background-color: #674A90">
                <div class="lh-100">
                    <h5 class="mb-0 text-white lh-100">{{ __('Welcome to') }} {{ config('app.name') }}{{ __('\'s project') }}</h5>
                </div>
            </div>
            <div class="my-3 p-3 bg-light rounded box-shadow">
                <h6 class="border-bottom border-gray pb-2 mb-0">{{ __('check your data below') }}</h6>
                <div class="media text-muted pt-3">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark">@my notes<span class="float-right">{{ $noteUserData }}</span></strong>
                    </p>
                </div>
                <div class="media text-muted pt-3">
                    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                        <strong class="d-block text-gray-dark">@my cards<span class="float-right">{{ $cardUserData }}</span></strong>
                    </p>
                </div>
                <div class="media text-muted pt-3">
                    <p class="media-body pb-3 mb-0 small lh-125">
                        <strong class="d-block text-gray-dark">@my card groups<span class="float-right">{{ $cardGroupUserData }}</span></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart->script() !!}
{!! $chart2->script() !!}
{!! $chart3->script() !!}
@endsection