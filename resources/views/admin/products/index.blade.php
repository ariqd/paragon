<x-layout>
    <x-slot name="title">
        Obat
    </x-slot>

    <x-slot name="pageTitle">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Obat</h3>
            <a href="{{ url('admin/products/create') }}" class="btn btn-primary">Tambah Produk</a>
        </div>
    </x-slot>

    <div class="row mt-3">
        <div class="col-12">
            <a href="{{ url('admin/products') }}"
                class="btn {{ !request()->get('category') ? 'btn-primary' : 'btn-outline-primary' }}">Semua Produk</a>
            <a href="{{ url('admin/products?category=Box') }}"
                class="btn {{ request()->get('category') == 'Box' ? 'btn-primary' : 'btn-outline-primary' }} ml-3">Box</a>
            <a href="{{ url('admin/products?category=Botol') }}"
                class="btn {{ request()->get('category') == 'Botol' ? 'btn-primary' : 'btn-outline-primary' }} ml-3">Botol</a>
            <a href="{{ url('admin/products?category=Tube') }}"
                class="btn {{ request()->get('category') == 'Tube' ? 'btn-primary' : 'btn-outline-primary' }} ml-3">Tube</a>
            <a href="{{ url('admin/products?category=Pot') }}"
                class="btn {{ request()->get('category') == 'Pot' ? 'btn-primary' : 'btn-outline-primary' }} ml-3">Pot</a>
        </div>
    </div>

    <div class="row mt-3">
        @forelse ($products as $product)
        <div class="col-3">
            <a href="{{ route('admin.products.edit', $product) }}" class="card">
                <div class="card-content">
                    <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" alt="singleminded">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            {{ $product->type }} &bull; Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <h3>No product available</h3>
        @endforelse
    </div>
</x-layout>
