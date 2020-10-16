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
                <div class="card-header">{{ __('Create a new') }}</div>

                <div class="card-body">

                    <form action="{{ route('user.notes.store') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputname">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ old('name') }}" autofocus>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="textareadescription">{{ __('Description') }}</label>
                                <textarea class="form-control" id="textareadescription" rows="15" name="description" autofocus>{{ old('description') }}</textarea>
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
                            <a class="btn btn-danger" href="{{ route('user.notes.index') }}" role="button" data-toggle="tooltip"
                            data-placement="top" title="{{ __('Cancel and return') }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
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
    $(".mselectCards").select2();
</script>
@endsection