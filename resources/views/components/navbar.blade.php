<nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="" width="100px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.notes.index') }}">{{ __('Notes') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.cards.index') }}">{{ __('Cards') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.cardgroups.index') }}">{{ __('Card groups') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Storage::disk('public')->exists(Auth::user()->avatar))
                            <span class="float-left mr-2"><img id="prevImg" src="{{ asset('/storage/'.Auth::user()->avatar) }}" alt="Avatar" class="avatar-image"></span>
                            @else
                            <span class="float-left mr-2"><img id="prevImg" src="{{ asset('img/system/main-avatar.png') }}" alt="Avatar" class="avatar-image"></span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @can('list-notes')
                            <a class="dropdown-item" href="{{ route('admin.notes.index') }}">
                                {{ __('Notes') }}
                            </a>
                            @endcan
                            @can('list-cards')
                            <a class="dropdown-item" href="{{ route('admin.cards.index') }}">
                                {{ __('Cards') }}
                            </a>
                            @endcan
                            @can('list-cardgroups')
                            <a class="dropdown-item" href="{{ route('admin.cardgroups.index') }}">
                                {{ __('Card groups') }}
                            </a>
                            @endcan
                            @can('list-user')
                            <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                {{ __('Users') }}
                            </a>
                            @endcan
                            @can('list-roles')
                            <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                {{ __('Roles') }}
                            </a>
                            @endcan
                            <a class="dropdown-item" href="{{ route('about') }}">
                                {{ __('About') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('users.profile', Auth::user()->id) }}">
                                {{ __('My Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>