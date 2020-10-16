@extends('layouts.app')

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header">
                    {{ __('Master cards') }}
                    @can('create-cards')
                    <span class="float-right ml-2">
                        <a class="btn btn-success btn-sm" href="{{ route('admin.cards.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Create a new') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                    </span>
                    @endcan
                    <span class="float-right">
                        <form action="{{ route('admin.cards.search') }}" method="post">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input type="text" name="dataToSearch" class="form-control" placeholder="{{ __('Filter') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" data-toggle="tooltip" data-placement="top" title="{{ __('Search') }}"><i class="fas fa-search"></i></button>
                                    <a class="btn btn-outline-secondary" href="{{ route('admin.cards.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Clear and return') }}"><i class="fas fa-undo-alt"></i></a>
                                </div>
                            </div>
                        </form>
                    </span>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-sm table-bordered table-hover table-borderless text-center" style="height: 100px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Login') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index)
                            <tr>
                                <td scope="row" class="align-middle">{{ $index->id }}</td>
                                <td class="align-middle">@if($index->name != null){{ Str::limit($index->name, 50) }}@endif</td>
                                <td class="align-middle">@if($index->login != null){{ $index->login }} @endif</td>
                                <td class="align-middle">
                                    @if($index->login != null)<button type="button" id="buttonEmail" class="btn button-without-style mr-1" data-clipboard-text="{{ $index->login }}" data-toggle="tooltip" data-placement="top" title="{{ __('Copy login') }}"><i class="fas fa-envelope text-dark"></i></button>@endif
                                    @if(Crypt::decrypt($index->password) != null)<button type="button" class="btn button-without-style mr-1 ml-1" data-clipboard-text="{{ Crypt::decrypt($index->password) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Copy password') }}"><i class="fas fa-key text-dark"></i></button>@endif
                                    @if($index->url != null)<button type="button" class="btn button-without-style mr-1 ml-1" data-clipboard-text="{{ $index->url }}" data-toggle="tooltip" data-placement="top" title="{{ __('Copy URL') }}"><i class="fas fa-globe text-dark"></i></button>@endif
                                    @if($index->url != null)<a target="_blank" href="{{ $index->url }}"><button type="button" class="btn button-without-style mr-1 ml-1" data-toggle="tooltip" data-placement="top" title="{{ __('Go to page') }}"><i class="fas fa-location-arrow text-dark"></i></button></a>@endif
                                    @can('update-cards')
                                    <a href="{{ route('admin.cards.edit', $index->id) }}" class="d-inline"><button type="button" class="button-without-style mr-1 ml-1" data-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}"><i class="fas text-dark fa-edit"></i></button></a>
                                    @endcan
                                    @can('delete-cards')
                                    <form action="{{ route('admin.cards.destroy', $index->id) }}" class="d-inline" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="button-without-style ml-1" data-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}"><i class="fas text-dark fa-trash"></i></button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <div class="d-flex justify-content-center">
                        {{ $data->links() }}
                        
                    </div>
                    <span class="d-flex justify-content-center">
                        {{ __('Showing') }} {{ $data->count() }} {{ __('of') }} {{ $data->total() }} {{ __('results') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection