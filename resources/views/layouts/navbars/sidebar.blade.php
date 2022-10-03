<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/WE.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/brand/logowe.png">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/WE.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            @if(Auth::user()->id_role == 1)
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('companies') }}">
                        <i class="far fa-building"></i> {{ __('Companies') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacts') }}">
                        <i class="far fa-address-card"></i> {{ __('Contacts') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('deals') }}">
                        <i class="far fa-handshake"></i> {{ __('Deals') }}
                    </a>
                </li>
                
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="far fa-file-alt"></i> {{ __('Invoice') }}
                    </a>
                </li> --}}
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                            <i class="fas fa-cogs"></i>
                            <span class="nav-link-text">{{ __('Properties') }}</span>
                        </a>
                        <div class="collapse show" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('userManagement') }}">
                                        {{ __('User Management') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('divisi') }}">
                                        {{ __('Divisi') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('coreBisnis') }}">
                                        {{ __('Core Bisnis') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('role') }}">
                                        {{ __('Role') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('stages') }}">
                                        {{ __('Stages') }}
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('products') }}">
                                        {{-- <i class="ni ni-tv-2 text-primary"></i> {{ __('Products') }} --}}
                                        {{__('Products')}}
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('source') }}">
                                        {{ __('Source') }}
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </li>
            </ul>
            @elseif(Auth::user()->id_role == 2)
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('companies') }}">
                        <i class="far fa-building"></i> {{ __('Companies') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacts') }}">
                        <i class="far fa-address-card"></i> {{ __('Contacts') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('deals') }}">
                        <i class="far fa-handshake"></i> {{ __('Deals') }}
                    </a>
                </li>
            </ul>
            @elseif(Auth::user()->id_role == 3)
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('requestInvoice')}}">
                        <i class="far fa-handshake"></i> {{ __('Sales Order') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('invoice')}}">
                        <i class="far fa-file-alt"></i> {{ __('Invoice') }}
                    </a>
                </li>
            </ul>
            @elseif(Auth::user()->id_role == 4)
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('companies') }}">
                        <i class="far fa-building"></i> {{ __('Companies') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contacts') }}">
                        <i class="far fa-address-card"></i> {{ __('Contacts') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('deals') }}">
                        <i class="far fa-handshake"></i> {{ __('Deals') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('invoice')}}">
                        <i class="far fa-file-alt"></i> {{ __('Invoice') }}
                    </a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                            <i class="fas fa-cogs"></i>
                            <span class="nav-link-text">{{ __('Properties') }}</span>
                        </a>
                        <div class="collapse show" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('userManagement') }}">
                                        {{ __('User Management') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('divisi') }}">
                                        {{ __('Divisi') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('coreBisnis') }}">
                                        {{ __('Core Bisnis') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('role') }}">
                                        {{ __('Role') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('stages') }}">
                                        {{ __('Stages') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('products') }}">
                                        {{-- <i class="ni ni-tv-2 text-primary"></i> {{ __('Products') }} --}}
                                        {{__('Products')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('source') }}">
                                        {{ __('Source') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
            </ul>
            @endif
        </div>
    </div>
</nav>
