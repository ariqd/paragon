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