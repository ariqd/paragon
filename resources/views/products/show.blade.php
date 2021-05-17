<x-layout>
    <x-slot name="title">
        Detail Obat
    </x-slot>

    <x-slot name="pageTitle">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Detail Obat</h3>
            <a href="{{ url('admin/products') }}" class="btn btn-outline-primary">Kembali ke Daftar Produk</a>
        </div>
    </x-slot>

    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <img src="{{ asset($product->image) }}" class="card-img-top img-fluid" alt="singleminded">
                    <form action="{{ route('cart.add', $product) }}" method="post">
                        @csrf
                        <div class="d-grid">
                            <button class="btn btn-primary mt-3" type="submit"
                                {{$product->stock <= 0 ? 'disabled' :''}}>
                                Tambahkan ke Keranjang
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <h4>{{ $product->name }}</h4>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <h4>Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                    </div>
                    <div class="form-group">
                        <label for="type">Jenis Packaging Obat</label>
                        <h4>{{ $product->type }}</h4>
                    </div>
                    <div class="form-group">
                        <label for="type">Tersedia:</label>
                        <h4>
                            @if ($product->stock <= 0) 0 pcs <span class="badge bg-secondary">Habis</span>
                                @else
                                {{ $product->stock }} pcs
                                @endif
                        </h4>
                    </div>
                    <div class="form-group">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
