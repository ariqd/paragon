<x-layout>
    <x-slot name="title">
        Detail Pesanan
    </x-slot>

    <div class="alert alert-{{ $order->statusColor() }} text-dark d-flex justify-content-between align-items-baseline">
        <div>
            <h4 class="alert-heading">{{ $order->status }}</h4>
        </div>
        <div>
            @if ($order->statusColor() == 'warning')
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#decline">
                <i class="bi bi-x"></i> Batalkan Pesanan
            </button>
            <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirm">
                <i class="bi bi-check"></i> Konfirmasi Pesanan
            </button>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4>Alamat Pengiriman</h4>
            <address>
                <span class="fw-bold">{{ $order->user->name }}</span> <br>
                <span>{{ $order->user->phone }}</span> <br>
                <span>{{ $order->user->address }}</span>
            </address>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-dark">
                        <tr scope="row">
                            <th scope="col" class="w-auto"></th>
                            <th scope="col" class="w-auto">Nama Obat</th>
                            <th scope="col" class="w-auto">Harga</th>
                            <th scope="col" class="w-auto">Jumlah</th>
                            @if ($order->statusColor() == 'warning')
                            <th scope="col" class="w-auto">Stok Saat Ini</th>
                            @endif
                            <th scope="col" class="w-auto">Subtotal</th>
                            <th scope="col" class="w-auto">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $index => $item)
                        <tr scope="row" class="{{ ($order->statusColor() == 'warning' && $item->product->stock < $item->quantity) ? 'table-danger' : '' }}">
                            <td class="w-25">
                                <img src="{{ asset($item->image) }}" class="w-50 mx-auto d-block" alt="singleminded">
                            </td>
                            <td class="font-weight-bold">{{ $item->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }} pcs</td>
                            @if ($order->statusColor() == 'warning')
                            <td>{{ $item->product->stock }} pcs</td>
                            @endif
                            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            <td>
                                @if ($order->statusColor() == 'warning' && $item->product->stock < $item->quantity)
                                    Jumlah pesanan melebihi stok saat ini.
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr scope="row">
                            <td colspan="5" class="text-end">
                                <strong>Total:</strong>
                            </td>
                            <td colspan="2">
                                <h4>Rp {{ number_format($order->total, 0, ',', '.') }}</h4>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="decline" tabindex="-1" aria-labelledby="declineTitle" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="declineTitle">Batalkan Pesanan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Batalkan pesanan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <form action="{{ route('admin.orders.update', $order) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <button type="submit" class="btn btn-danger ml-1" value="decline" name="decision">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batalkan Pesanan</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm" tabindex="-1" aria-labelledby="confirmTitle" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmTitle">Konfirmasi Pesanan</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Konfirmasi pesanan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <form action="{{ route('admin.orders.update', $order) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <button type="submit" class="btn btn-success ml-1" value="confirm" name="decision">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Konfirmasi Pesanan</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
