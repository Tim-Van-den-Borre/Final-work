<div id="appWrapper" class="d-flex">
    <div id="appMenu" class="bg-light border-right">
        <div id="appMenuHeader">
            <img id="appMenuHeaderImage" src="{{ URL::to('/images/Logo5.png') }}"/>
        </div>
        <div class="list-group list-group-flush">
            @if (Auth::check())
                @if (Route::has('login'))
                    <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                        {{ __('Home') }}
                    </a>

                    <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </a>

                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor')
                        <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('patients') }}" :active="request()->routeIs('patients')">
                            {{ __('Patients') }}
                        </a>
                    @endif

                    @if(Auth::user()->role == 'Admin')
                        <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('doctors') }}" :active="request()->routeIs('doctors')">
                            {{ __('Doctors') }}
                        </a>
                    @endif

                    @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Doctor' || Auth::user()->role == 'Patient')
                        <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('appointments') }}" :active="request()->routeIs('appointments')">
                            {{ __('Appointments') }}
                        </a>
                    @endif

                    @if(Auth::user()->role == 'Patient')
                        <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('medical-history') }}" :active="request()->routeIs('medical-history')">
                            {{ __('Medical History') }}
                        </a>
                    @endif
                    
                    <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('calender') }}" :active="request()->routeIs('calender')">
                        {{ __('Calender') }}
                    </a>
                    
                    <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('profile.show') }}">
                        {{ __('Profile') }}
                    </a>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </a>
                    @endif

                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                            {{ __('Team Settings') }}
                        </a>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('teams.create') }}">
                                {{ __('Create New Team') }}
                            </a>
                        @endcan

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-jet-switchable-team :team="$team" />
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a id="appMenuLinkLogout" class="list-group-item list-group-item-action bg-light" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </form>
                @endif
            @else
                <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('welcome') }}" :active="request()->routeIs('welcome')">
                    {{ __('Home') }}
                </a>
                
                <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('login') }}" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </a>

                <a id="appMenuLink" class="list-group-item list-group-item-action bg-light" href="{{ route('register') }}" :active="request()->routeIs('login')">
                    {{ __('Register') }}
                </a>
            @endif
        </div>
    </div>
    <div id="appPageContent">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button id="appMenuToggle" class="btn btn-secondary btn-sm">
                <i class="bi bi-list"></i>
            </button>
            @if (Auth::check())
                @if (Route::has('login'))
                    <div class="hidden navbar-nav ml-auto mt-2 mt-lg-0">
                        <div class="row">
                            <span id="appUsername">{{ Auth::user()->name }}</span>  
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img id="appProfilePicture" class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <div class="hidden navbar-nav ml-auto mt-2 mt-lg-0">
                    <div class="row">
                        <span id="appUsername">Guest</span>  
                    </div>
                </div>
            @endif
        </nav>
        <div class="container-fluid">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
            {{ $slot }}
        </div>
    </div>
</div>