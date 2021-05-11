<x-layout>
    <x-slot name="title">
        Keranjang Belanja
    </x-slot>

    {{-- <x-slot name="subtitle">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt et vel unde, quae culpa alias repellendus.
    </x-slot> --}}

    <div class="card">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="thead-dark">
                    <tr scope="row">
                        <th scope="col" class="w-auto"></th>
                        <th scope="col" class="w-auto">Nama Obat</th>
                        <th scope="col" class="w-auto">Harga</th>
                        <th scope="col" class="w-auto">Kuantitas</th>
                        <th scope="col" class="w-auto">Subtotal</th>
                        <th scope="col" class="w-auto"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cart['items'] as $cartItemIndex => $product)
                    <tr scope="row">
                        <td class="w-25">
                            <img src="{{ asset($product['image']) }}" class="w-50 mx-auto d-block" alt="singleminded">
                        </td>
                        <td class="font-weight-bold">{{ $product['name'] }}</td>
                        <td>Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.decrement', $cartItemIndex) }}" class="d-inline-block" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">-</button>
                            </form>
                            <span class="mx-3">
                                {{ $product['quantity'] }}
                            </span>
                            <form action="{{ route('cart.increment', $cartItemIndex) }}" class="d-inline-block" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">+</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</td>
                        <td class="text-center">
                            <form action="{{ route('cart.remove', $cartItemIndex) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-light">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <h5 class="text-center">Keranjang Belanja Kosong</h5>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr scope="row">
                        <td colspan="4" class="text-end">
                            <strong>Total:</strong>
                        </td>
                        <td>Rp {{ number_format($cart['payable'], 0, ',', '.') }}</td>
                        <td class="d-grid">
                            <a href="" class="btn btn-primary">Checkout</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</x-layout>
