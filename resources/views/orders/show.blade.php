<x-layout>
    <x-slot name="title">
        Detail Pesanan
    </x-slot>

    <div class="alert alert-{{ $order->statusColor() }} text-dark">
        <h4 class="alert-heading">{{ $order->status }}</h4>
        <p class="fw-light">
            {{ $order->statusMessage() }}
            @if (@$order->cancel_reason)
            Alasan: {{ $order->cancel_reason }}
            @endif
        </p>
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
                            <th scope="col" class="w-auto">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $index => $item)
                        <tr scope="row">
                            <td class="w-25">
                                <img src="{{ asset($item->image) }}" class="w-50 mx-auto d-block" alt="singleminded">
                            </td>
                            <td class="font-weight-bold">{{ $item->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                <span class="mx-3">
                                    {{ $item->quantity }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr scope="row">
                            <td colspan="4" class="text-end">
                                <strong>Total:</strong>
                            </td>
                            <td>
                                <h4>
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </h4>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-layout>
