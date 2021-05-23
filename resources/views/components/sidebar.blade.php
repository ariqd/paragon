<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/images/logo/paragon_logo.jpeg') }}" alt="paragon_logo" class="h-50">
            </a>
            <div class="d-flex justify-content-between">
                @if (@Auth::guard('admin')->check())
                <div class="logo mt-3">
                    Admin
                </div>
                @endif
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                @if (auth()->guard('admin')->check())

                @include('components.sidebar-admin')

                @else

                @include('components.sidebar-user')

                @endif
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
