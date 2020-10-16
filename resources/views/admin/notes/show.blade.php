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
                <div class="card-header">{{ __('Edit existing') }} 1</div>

                <div class="card-body">

                    <form action="{{ route('admin.notes.update', $note) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputname">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $note->name }}" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="textareadescription">{{ __('Description') }}</label>
                                <textarea class="form-control" id="textareadescription" rows="15" name="description" disabled>{{ $note->description }}</textarea>
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
                            <a class="btn btn-danger" href="{{ route('admin.notes.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Cancel and return') }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <a class="btn btn-primary" href="{{ route('admin.notes.edit', $note) }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Cancel and return') }}">{{ __('Edit') }}</a>
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