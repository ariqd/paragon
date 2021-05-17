<x-layout>
    <x-slot name="title">
        Keranjang Belanja
    </x-slot>

    <div class="card">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="thead-dark">
                    <tr scope="row">
                        <th scope="col" class="w-auto"></th>
                        <th scope="col" class="w-auto">Nama Obat</th>
                        <th scope="col" class="w-auto">Harga</th>
                        <th scope="col" class="w-auto">Jumlah</th>
                        <th scope="col" class="w-auto">Subtotal</th>
                        <th scope="col" class="w-auto"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cart['items'] as $cartItemIndex => $product)
                    @php
                    // dd($product['modelId']);
                    // dd(array_column($removed, 'id'));
                    // dd();
                    // dd(in_array())
                    $currentRemovedItem = [];
                    if (in_array($product['modelId'], array_column($removed, 'id'))) {
                    $currentRemovedItem = $removed[array_search($product['modelId'], array_column($removed, 'id'))];
                    }
                    @endphp
                    <tr scope="row"
                        class="{{ in_array($product['modelId'], array_column($removed, 'id')) ? 'table-active' : '' }}">
                        <td class="w-25">
                            <img src="{{ asset($product['image']) }}" class="w-50 mx-auto d-block" alt="singleminded">
                        </td>
                        <td class="font-weight-bold">{{ $product['name'] }}</td>
                        <td>Rp {{ number_format($product['price'], 0, ',', '.') }}</td>
                        <td>
                            @if (!empty($currentRemovedItem) && $currentRemovedItem['stock_left'] == 0)
                            <span>Stok Habis</span>
                            @else
                            <form
                                action="{{ route('cart.decrement', ['id' => $cartItemIndex, 'product' => $product['modelId']]) }}"
                                class="d-inline-block" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">-</button>
                            </form>
                            <span class="mx-3">
                                {{ $product['quantity'] }} pcs
                            </span>
                            <form
                                action="{{ route('cart.increment', ['id' => $cartItemIndex, 'product' => $product['modelId']]) }}"
                                class="d-inline-block" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">+</button>
                            </form>
                            @endif
                            <br>
                            @if (!empty($currentRemovedItem) && $currentRemovedItem['stock_left'] != 0)
                            <div class="mt-1">Sisa stok: {{$currentRemovedItem['stock_left']}} pcs</div>
                            @endif
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
                        <td>
                            <h4>
                                Rp {{ number_format($cart['payable'], 0, ',', '.') }}
                            </h4>
                        </td>
                        <td class="d-grid">
                            <button type="button" class="btn btn-primary block" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter" @if($count> 0) disabled @endif>
                                Checkout
                            </button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Pesanan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Konfirmasi pesanan untuk {{ array_sum(array_column(cart()->items(), 'quantity')) }} obat ini?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <form action="{{ route('order.checkout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Checkout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>
