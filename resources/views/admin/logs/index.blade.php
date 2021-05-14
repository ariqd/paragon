<x-layout>
    <x-slot name="title">
        Log Aktifitas
    </x-slot>

    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    </x-slot>

    <x-slot name="js">
        <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script>
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
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->created_at->toDayDateTimeString() }}</td>
                        <td>{{ $activity->message }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
