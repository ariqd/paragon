<x-layout>
    <x-slot name="title">
        Chat
    </x-slot>

    <x-slot name="pageTitle">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Chat</h3>
            <div>
                @if(!$chat->resolved)
                <form action="{{ route('chat.resolve', $chat) }}" method="post">
                    @csrf
                    <div class="input-group">
                        <button class="btn btn-success" type="submit">
                            <i class="bi bi-check"></i>
                            Pertanyaan Terjawab
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </x-slot>

    <x-slot name="css">
        <style>
            body {
                margin-top: 20px;
            }

            .chat-online {
                color: #34ce57
            }

            .chat-offline {
                color: #e4606d
            }

            .chat-messages {
                display: flex;
                flex-direction: column;
                max-height: 550px;
                overflow-y: scroll
            }

            .chat-message-left,
            .chat-message-right {
                display: flex;
                flex-shrink: 0
            }

            .chat-message-left {
                margin-right: auto
            }

            .chat-message-right {
                flex-direction: row-reverse;
                margin-left: auto
            }

            .py-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }

            .px-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important;
            }

            .flex-grow-0 {
                flex-grow: 0 !important;
            }

            .border-top {
                border-top: 1px solid #dee2e6 !important;
            }
        </style>
    </x-slot>

    <main class="content mt-3">
        <div class="row g-0">
            <div class="col-12">
                <div class="position-relative">
                    <div class="chat-messages p-4 bg-white">
                        @foreach ($chat->messages as $message)
                        <div
                            class="{{ $message->is_admin ? 'chat-message-left' : 'chat-message-right' }} pb-4 d-flex align-items-center">
                            <div>
                                <div class="text-muted small text-nowrap mt-2">
                                    {{ $message->created_at->format('h:i A') }}
                                </div>
                            </div>
                            <div class="flex-shrink-1 rounded py-2 px-3 mx-3 bg-light">
                                <div class="fw-bold mb-1">
                                    {{ $message->is_admin ? 'Admin' : 'Saya' }}
                                </div>
                                {{ $message->message }}
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                @if(!$chat->resolved)

                <div class="flex-grow-0 mt-3 border-top">
                    <form action="{{ route('chat.update', $chat) }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tulis pesan anda" name="message">
                            <button class="btn btn-primary" type="submit">Kirim</button>
                        </div>
                    </form>
                </div>

                @endif

            </div>
        </div>
    </main>
</x-layout>
