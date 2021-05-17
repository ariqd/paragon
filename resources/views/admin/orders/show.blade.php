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
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <button type="submit" class="btn btn-success">
                    Konfirmasi Pesanan
                </button>
            </form>
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
                            <th scope="col" class="w-auto">Stok Saat Ini</th>
                            <th scope="col" class="w-auto">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $index => $item)
                        @php
                            // $product = App\Models\Product::find($item->id);
                            dd($item);
                        @endphp
                        <tr scope="row">
                            <td class="w-25">
                                <img src="{{ asset($item->image) }}" class="w-50 mx-auto d-block" alt="singleminded">
                            </td>
                            <td class="font-weight-bold">{{ $item->name }}</td>
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                {{ $item->quantity }} pcs
                            </td>
                            <td>
                                {{ $product->stock }} pcs
                            </td>
                            <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr scope="row">
                            <td colspan="5" class="text-end">
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
