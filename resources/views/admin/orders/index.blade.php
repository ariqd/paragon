<x-layout>
    <x-slot name="title">
        Semua Pesanan
    </x-slot>

    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    </x-slot>

    <x-slot name="js">
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table1');
            let dataTable = new simpleDatatables.DataTable(table1);
        </script>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="table1">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->count }} pcs Obat</td>
                        <td>
                            <span class="badge bg-{{ $order->statusColor() }}">{{ $order->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}">Detail Pesanan</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
