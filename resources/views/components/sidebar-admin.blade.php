<li class="sidebar-item {{ request()->is('admin/products*') ? 'active' : '' }}">
    <a href="{{ url('admin/products') }}" class='sidebar-link'>
        <i class="bi bi-shop"></i>
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
        <i class="bi bi-shop"></i>
        <span>Log Status</span>
    </a>
</li>
