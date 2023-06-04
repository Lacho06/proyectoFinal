<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto w-100">
        <li class="dropdown">
            <a id="navbarDropdownNotification" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
                <span class="badge badge-light bg-danger badge-xs">{{auth()->user()->unreadNotifications->count()}}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownNotification">
                <h6 class="dropdown-header">Notificaciones</h6>
                <div class="dropdown-divider"></div>
                <ul>
                    @if (auth()->user()->unreadNotifications)
                        <li class="d-flex justify-content-end mx-1 my-2">
                            <a href="{{route('mark-all-as-read')}}" class="btn btn-success btn-sm dropdown-item">Marcar todo como leído</a>
                        </li>
                    @endif
                    @foreach (auth()->user()->unreadNotifications as $notification)
                        <a href="{{ route('mark-as-read', $notification->id) }}" class="text-success"><li class="p-1 text-success dropdown-item">{{$notification->data['data']}}</li></a>
                    @endforeach
                    @foreach (auth()->user()->readNotifications()->take(5)->orderBy('updated_at', 'desc')->get() as $notification)
                        <li class="p-1 text-secondary dropdown-item">{{$notification->data['data']}}</li>
                    @endforeach
                </ul>
            </div>
        </li>
        <div class="dropdown ml-auto">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i> <span>{{ auth()->user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Salir
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        {{-- @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif --}}

        {{-- Right sidebar toggler link --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>
