<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            {!! config('app.name', trans('titles.app')) !!}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- Left Side Of Navbar --}}
            <ul class="navbar-nav mr-auto">
                @role('admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.adminDropdownNav') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ (Request::is('roles') || Request::is('permissions')) ? 'active' : null }}"
                           href="{{ route('laravelroles::roles.index') }}">
                            {!! trans('titles.laravelroles') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null }}"
                           href="{{ url('/users') }}">
                            {!! trans('titles.adminUserList') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('users/create') ? 'active' : null }}"
                           href="{{ url('/users/create') }}">
                            {!! trans('titles.adminNewUser') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('themes','themes/create') ? 'active' : null }}"
                           href="{{ url('/themes') }}">
                            {!! trans('titles.adminThemesList') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('logs') ? 'active' : null }}" href="{{ url('/logs') }}">
                            {!! trans('titles.adminLogs') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}"
                           href="{{ url('/activity') }}">
                            {!! trans('titles.adminActivity') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('phpinfo') ? 'active' : null }}"
                           href="{{ url('/phpinfo') }}">
                            {!! trans('titles.adminPHP') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('routes') ? 'active' : null }}"
                           href="{{ url('/routes') }}">
                            {!! trans('titles.adminRoutes') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('active-users') ? 'active' : null }}"
                           href="{{ url('/active-users') }}">
                            {!! trans('titles.activeUsers') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('blocker') ? 'active' : null }}"
                           href="{{ route('laravelblocker::blocker.index') }}">
                            {!! trans('titles.laravelBlocker') !!}
                        </a>
                    </div>
                </li>
                @endrole

                @role('atmcollector|atmadmin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.verticalSignalsDropdownNav') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @role('atmadmin')
                        <a class="dropdown-item {{ Request::is('signals-inventory', 'signals-inventory/*') ? 'active' : null }}"
                           href="{{ URL::to('/signals-inventory/') }}">
                            {!! trans('titles.vsignalsInventory') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        @endrole
                        <a class="dropdown-item {{ Request::is('vertical-signals', 'vertical-signals/*') ? 'active' : null }}"
                           href="{{ URL::to('/vertical-signals/') }}">
                            {!! trans('titles.verticalSignals') !!}
                        </a>
                    </div>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.trafficLightsDropdownNav') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @role('atmadmin')
                        <a class="dropdown-item {{ Request::is('devices-inventory', 'devices-inventory/*') ? 'active' : null }}"
                           href="{{ URL::to('/devices-inventory/') }}">
                            {!! trans('titles.deviceInventory') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        @endrole
                        <a class="dropdown-item {{ Request::is('intersections', 'intersections/*') ? 'active' : null }}"
                           href="{{ URL::to('/intersections/') }}">
                            {!! trans('titles.intersections') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('regulator-boxes', 'regulator-boxes/*') ? 'active' : null }}"
                           href="{{ URL::to('/regulator-boxes/') }}">
                            {!! trans('titles.regulator-boxes') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('traffic-poles', 'traffic-poles/*') ? 'active' : null }}"
                           href="{{ URL::to('/traffic-poles/') }}">
                            {!! trans('titles.traffic-poles') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('traffic-tensors', 'traffic-tensors/*') ? 'active' : null }}"
                           href="{{ URL::to('/traffic-tensors/') }}">
                            {!! trans('titles.traffic-tensors') !!}
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item {{ Request::is('traffic-lights', 'traffic-lights/*') ? 'active' : null }}"
                           href="{{ URL::to('/traffic-lights/') }}">
                            {!! trans('titles.trafficLights') !!}
                        </a>
                    </div>
                </li>
                @endrole

                @role('atmoperator|atmadmin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.workOrdersDropdownNav') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ Request::is('workorders', 'workorders/*') ? 'active' : null }}"
                           href="{{ URL::to('/workorders/') }}">
                            {!! trans('titles.ordersList') !!}
                        </a>
                    </div>
                </li>
                @endrole

                @role('atmoperator|atmadmin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {!! trans('titles.reportsDropdownNav') !!}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item {{ Request::is('reports/vertical-signals') ? 'active' : null }}"
                           href="{{ URL::to('/reports/vertical-signals') }}">
                            {!! trans('titles.verticial-signals') !!}
                        </a>
                    </div>
                </li>
                @endrole
            </ul>
            {{-- Right Side Of Navbar --}}
            <ul class="navbar-nav ml-auto">
                {{-- Authentication Links --}}
                @auth
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}"
                                     class="user-avatar-nav">
                            @else
                                <div class="user-avatar-nav"></div>
                            @endif
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}"
                               href="{{ url('/profile/'.Auth::user()->name) }}">
                                {!! trans('titles.profile') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>