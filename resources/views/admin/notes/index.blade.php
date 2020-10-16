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
                    {{ __('Master notes') }}
                    @can('create-notes')
                    <span class="float-right ml-2">
                        <a class="btn btn-success btn-sm" href="{{ route('admin.notes.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Create a new') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                    </span>
                    @endcan
                    <span class="float-right">
                        <form action="{{ route('admin.notes.search') }}" method="post">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input type="text" name="dataToSearch" class="form-control" placeholder="{{ __('Filter') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" data-toggle="tooltip" data-placement="top" title="{{ __('Search') }}"><i class="fas fa-search"></i></button>
                                    <a class="btn btn-outline-secondary" href="{{ route('admin.notes.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Clear and return') }}"><i class="fas fa-undo-alt"></i></a>
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
                                <th>{{ __('Description') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index)
                            <tr>
                                <td scope="row" class="align-middle">{{ $index->id }}</td>
                                <td class="align-middle">@if($index->name != null){{ Str::limit($index->name, 50) }}@endif</td>
                                <td class="align-middle">@if($index->description != null){{ Str::limit($index->description, 50) }} @endif</td>
                                <td class="align-middle">
                                    @can('show-notes')
                                    <a href="{{ route('admin.notes.show', $index->id) }}" class="d-inline"><button type="button" class="button-without-style mr-1 ml-1" data-toggle="tooltip" data-placement="top" title="{{ __('Show') }}"><i class="fas text-dark fa-eye"></i></button></a>
                                    @endcan
                                    @can('update-notes')
                                    <a href="{{ route('admin.notes.edit', $index->id) }}" class="d-inline"><button type="button" class="button-without-style mr-1 ml-1" data-toggle="tooltip" data-placement="top" title="{{ __('Edit') }}"><i class="fas text-dark fa-edit"></i></button></a>
                                    @endcan
                                    @can('delete-notes')
                                    <form action="{{ route('admin.notes.destroy', $index->id) }}" class="d-inline" method="POST">
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
@component('components.modal', ['id'=>'showCopiedFeature'])

    <div class="text-center">
        <span class="font-weight-bolder" id="copiedElement"></span>
    </div>
    
    @slot('footer')
        <button type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
    @endslot
@endcomponent
@endsection

@section('extra-scripts')
<script type="text/javascript">
    var clipboard = new ClipboardJS('.btn');

    clipboard.on('success', function(e) {
        $("#copiedElement").html("Elemento copiado com sucesso!");
        $("#showCopiedFeature").modal("show");
        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        alert("erro ao copiar elemento.");
    });
</script>
@endsection