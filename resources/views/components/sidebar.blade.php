<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{url('/')}}">
                        Paragon
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class='sidebar-link'>
                        <i class="bi bi-shop"></i>
                        <span>Obat</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('keranjang') ? 'active' : '' }}">
                    <a href="{{ url('keranjang') }}" class='sidebar-link'>
                        <i class="bi bi-cart-fill"></i>
                        <span>Keranjang</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('pesanan-saya') ? 'active' : '' }}">
                    <a href="{{ url('pesanan-saya') }}" class='sidebar-link'>
                        <i class="bi bi-list"></i>
                        <span>Pesanan Saya</span>
                    </a>
                </li>

                <li class="sidebar-item  {{ request()->is('tentang') ? 'active' : '' }}">
                    <a href="{{ url('tentang') }}" class='sidebar-link'>
                        <i class="bi bi-patch-question-fill"></i>
                        <span>Tentang</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('visi-misi') ? 'active' : '' }}">
                    <a href="{{ url('visi-misi') }}" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Visi Misi</span>
                    </a>
                </li>

                <li class="sidebar-title">{{ auth()->user()->name }}</li>

                <li class="sidebar-item">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();" class='sidebar-link'>

                            <i class="bi bi-arrow-left-square-fill"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
