<x-layout>
    <x-slot name="title">
        Obat
    </x-slot>

    <x-slot name="pageTitle">
        <h3>Obat</h3>
    </x-slot>

    <div class="row mt-3">
        <div class="col-8">
            <a href="{{ url('/') }}"
                class="btn {{ !request()->get('category') ? 'btn-primary' : 'btn-outline-primary' }}">Semua Produk</a>
            <a href="{{ url('/?category=Box') }}"
                class="btn {{ request()->get('category') == 'Box' ? 'btn-primary' : 'btn-outline-primary' }} ml-3">Box</a>
            <a href="{{ url('/?category=Botol') }}"
                class="btn {{ request()->get('category') == 'Botol' ? 'btn-primary' : 'btn-outline-primary' }} ml-3">Botol</a>
            <a href="{{ url('/?category=Tube') }}"
                class="btn {{ request()->get('category') == 'Tube' ? 'btn-primary' : 'btn-outline-primary' }} ml-3">Tube</a>
            <a href="{{ url('/?category=Pot') }}"
                class="btn {{ request()->get('category') == 'Pot' ? 'btn-primary' : 'btn-outline-primary' }} ml-3">Pot</a>
        </div>
        <div class="col-4 align-items-end">
            <form action="{{ url('/') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Ketik nama obat" aria-label="Ketik nama obat"
                        aria-describedby="button-addon2" name="nama" value={{ @request()->get('nama') }}>
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        @forelse ($products as $product)
        <div class="col-3">
            <a href="{{ route('products.show', $product) }}" class="card">
                <div class="card-content">
                    <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" alt="singleminded">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $product->name }}
                        </h5>
                        <p class="card-text">
                            {{ $product->type }} &bull; Rp {{ number_format($product->price, 0, ',', '.') }} &bull;
                            @if ($product->stock < 10) <span class="badge bg-secondary">Habis</span>
                                @else
                                {{ $product->stock }} pcs
                                @endif
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
