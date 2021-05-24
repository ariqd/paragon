<x-layout>
    <x-slot name="title">
        Pesanan Saya
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

            var myModal = new bootstrap.Modal(document.getElementById('successModal'))

            @if (@session('info'))

            myModal.show()

            @endif
        </script>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="table1">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
                        <td>{{ $order->count }} pcs Obat</td>
                        <td>
                            <span class="badge bg-{{ $order->statusColor() }}">{{ $order->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('order.show', $order) }}">Detail Pesanan</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Checkout Berhasil!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Terima kasih telah memesan, silahkan tunggu konfirmasi dari kami.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</x-layout>
