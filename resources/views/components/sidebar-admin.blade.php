<li class="sidebar-item {{ request()->is('admin/products*') ? 'active' : '' }}">
    <a href="{{ url('admin/products') }}" class='sidebar-link'>
        <i class="bi bi-file-earmark-plus-fill"></i>
        <span>Obat</span>
    </a>
</li>

<li class="sidebar-item {{ request()->is('admin/orders*') ? 'active' : '' }}">
    <a href="{{ url('admin/orders') }}" class='sidebar-link'>
        <i class="bi bi-shop"></i>
        <span>Pesanan</span>
    </a>
</li>

<li class="sidebar-item {{ request()->is('admin/logs*') ? 'active' : '' }}">
    <a href="{{ url('admin/logs') }}" class='sidebar-link'>
        <i class="bi bi-clock-fill"></i>
        <span>Log Status</span>
    </a>
</li>

<li class="sidebar-title">{{ auth()->guard('admin')->user()->name }}</li>

<li class="sidebar-item">

    <form method="POST" action="{{ route('logout-admin') }}">
        @csrf

        <a href="route('logout-admin')" onclick="event.preventDefault();
                                this.closest('form').submit();" class='sidebar-link'>

            <i class="bi bi-arrow-left-square-fill"></i>
            <span>Logout</span>
        </a>
    </form>
</li>
