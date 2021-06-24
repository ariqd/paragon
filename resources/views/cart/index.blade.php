<x-layout>
    <x-slot name="title">
        Keranjang Belanja
    </x-slot>

    <div class="card">
        <div class="table-responsive">
            <table class="table mb-0 align-middle table-hover">
                <thead class="thead-dark">
                    <tr scope="row">
                        <th scope="col" class="text-center w-50">Obat</th>
                        <th scope="col" class="text-center w-auto">Jumlah</th>
                        <th scope="col" class="text-center w-auto">Subtotal</th>
                        <th scope="col" class="text-center w-auto"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cart['items'] as $cartItemIndex => $product)
                    @php
                    $currentRemovedItem = [];
                    if (in_array($product['modelId'], array_column($removed, 'id'))) {
                    $currentRemovedItem = $removed[array_search($product['modelId'], array_column($removed, 'id'))];
                    }
                    @endphp
                    <tr scope="row">
                        <td style="white-space:nowrap">
                            <div class="row d-inline-block float-none">
                                <div class="col-md-3 d-inline-block float-none">
                                    <img src="{{ asset($product['image']) }}" class="img-fluid"
                                        alt="{{ $product['name'] }}">
                                </div>
                                <div class="col-md-9 d-inline-block float-none">
                                    {{ $product['name'] }} <br>
                                    Rp {{ number_format($product['price'], 0, ',', '.') }}
                                </div>
                            </div>
                        </td>
                        <td style="white-space:nowrap">
                            <div class="row d-inline-block float-none">
                                @if (!empty($currentRemovedItem) && !$currentRemovedItem['stock_left'])
                                <div>Stok Habis</div>
                                @else
                                <form
                                    action="{{ route('cart.decrement', ['id' => $cartItemIndex, 'product' => $product['modelId']]) }}"
                                    method="post" class="col-md-2 d-inline-block float-none p-0">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-icon btn-{{ $product['quantity'] <= 10 ? 'outline-primary disabled' : 'primary' }} btn-sm btn-block">
                                        <i class="bi bi-dash-circle" style="font-size:12px"></i>
                                    </button>
                                </form>
                                <form
                                    action="{{ route('cart.update', ['id' => $cartItemIndex, 'product' => $product['modelId']]) }}"
                                    method="post" class="col-md-8 d-inline-block float-none p-0">
                                    @csrf
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control form-control-sm" placeholder="qty"
                                            aria-label="qty" aria-describedby="basic-addon2"
                                            value="{{ $product['quantity'] }}" name="newQty">
                                        <span class="input-group-text">
                                            {{ $removed[$cartItemIndex]['type'] == 'Box' ? 'Pcs' : $removed[$cartItemIndex]['type'] }}
                                            / box
                                        </span>
                                        <div class="input-group-append" id="basic-addon2">
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </div>
                                    </div>
                                </form>
                                <form
                                    action="{{ route('cart.increment', ['id' => $cartItemIndex, 'product' => $product['modelId']]) }}"
                                    method="post" class="col-md-2 d-inline-block float-none p-0">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm btn-block"
                                        {{ !empty($currentRemovedItem) && ($currentRemovedItem['stock_left'] <= $product['quantity']) ? 'disabled' : ''}}>
                                        <i class="bi bi-plus-circle" style="font-size:12px"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                        <td class="text-center">Rp
                            {{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }}</td>
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
                        <td colspan="2" class="text-end">
                            <strong>Total:</strong>
                        </td>
                        <td>
                            <h5>
                                Rp {{ number_format($cart['payable'], 0, ',', '.') }}
                            </h5>
                        </td>
                        <td class="d-grid">
                            <button type="button" class="btn btn-primary block" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter">
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
