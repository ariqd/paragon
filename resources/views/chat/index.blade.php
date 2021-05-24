<x-layout>
    <x-slot name="title">
        Chat
    </x-slot>

    <x-slot name="pageTitle">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Chat</h3>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="table1">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Produk Yang Ditanyakan</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chats as $chat)
                    @php
                    $unread = $chat->messages->where('is_read', false)->where('is_admin', true)->count();
                    @endphp
                    <tr>
                        <td>{{ $chat->created_at->toDayDateTimeString() }}</td>
                        <td>{{ $chat->product->name }}</td>
                        <td>{{ $chat->resolved ? 'Selesai' : 'Ongoing' }}</td>
                        <td>
                            <a href="{{ route('chat.show', $chat) }}">
                                Lihat Chat
                                @if (!$chat->resolved)
                                <span class="badge bg-primary">{{ $unread }}</span>
                                @endif
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
