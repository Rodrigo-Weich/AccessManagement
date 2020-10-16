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

                    <form action="{{ route('user.cardgroups.update', $card) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputname">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $card->name }}" autofocus>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="textareadescription">{{ __('Description') }}</label>
                                <textarea class="form-control" id="textareadescription" rows="5" name="description" autofocus>{{ $card->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="cards[]">{{ __('Cards') }}:</label>
                                <select name="cards[]" class="mselectCards form-control" multiple="true">
                                    @foreach($data as $index)
                                        <option value="{{ $index->id }}" @if($card->cards->pluck('id')->contains($index->id)) selected @endif>@if($index->owner != 1){{ Str::limit($index->name, 50) }}@else {{ Str::limit($index->name, 50) }}*@endif</option>
                                    @endforeach
                                </select>
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
                            <a class="btn btn-danger" href="{{ route('user.cardgroups.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Cancel and return') }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
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
    $(".mselectCards").select2();
</script>
@endsection