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
                    {{ __('Users') }}
                    @can('create-user')
                    <span class="float-right ml-2">
                        <a class="btn btn-success btn-sm" href="{{ route('admin.users.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Create a new') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                    </span>
                    @endcan
                    <span class="float-right">
                        <form action="{{ route('admin.users.search') }}" method="post">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input type="text" name="dataToSearch" class="form-control" placeholder="{{ __('Filter') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" data-toggle="tooltip" data-placement="top" title="{{ __('Search') }}"><i class="fas fa-search"></i></button>
                                    <a class="btn btn-outline-secondary" href="{{ route('admin.users.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Clear and return') }}"><i class="fas fa-undo-alt"></i></a>
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
                                <th></th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('E-Mail') }}</th>
                                <th>{{ __('Role') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td scope="row" class="align-middle">{{ $user->id }}</td>
                                <td class="align-middle">
                                    @if(Storage::disk('public')->exists($user->avatar))
                                        <img id="prevImg" src="{{ asset('/storage/'.$user->avatar) }}" alt="Avatar" class="avatar-image">
                                    @else
                                        <img id="prevImg" src="{{ asset('img/system/main-avatar.png') }}" alt="Avatar" class="avatar-image">
                                    @endif
                                </td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">
                                    @if ($user->roles()->count() > 1)
                                        {{ __($user->roles()->get()->pluck('name')->min()) }} {{ __('and') }} {{ $user->roles()->count()-1 }} {{ __('more') }}
                                    @elseif ($user->roles()->count() < 1)
                                        <span class="badge badge-danger"><i class="fas fa-exclamation-circle"></i> {{ __('No role') }}</span>
                                    @else
                                        {{ __(implode(', ', $user->roles()->get()->pluck('name')->toArray())) }}
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @can('update-user')
                                        @if(!($user->unalterable === 1))
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="d-inline"><button type="button" class="button-without-style mr-1"><i class="fas text-dark fa-edit"></i></button></a>
                                        @endif
                                    @endcan
                                    @can('delete-user')
                                        @if(!($user->unalterable === 1))
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" class="d-inline" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="button-without-style ml-1"><i class="fas text-dark fa-trash"></i></button>
                                        </form>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                        
                    </div>
                    <span class="d-flex justify-content-center">
                        {{ __('Showing') }} {{ $users->count() }} {{ __('of') }} {{ $users->total() }} {{ __('results') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection