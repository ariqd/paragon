<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index', [
            'chats' => Chat::where('user_id', auth()->id())->latest()->get()
        ]);
    }

    public function store(Request $request, Product $product)
    {
        $message = $request->all();

        $chat = Chat::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);

        if ($chat) {
            ChatMessage::create([
                'message' => $message['message'],
                'chat_id' => $chat->id,
            ]);

            return redirect()->back()->with('info', 'Pertanyaan telah diajukan');
        }

        return redirect()->back()->with('info', 'Pertanyaan gagal diajukan');
    }

    public function show(Chat $chat)
    {
        foreach ($chat->messages as $message) {
            if (!$message->is_read && $message->is_admin) {
                $message->is_read = true;
                $message->save();
            }
        }

        return view('chat.show', [
            'chat' => $chat
        ]);
    }

    public function update(Request $request, Chat $chat)
    {
        $message = $request->all();

        if (ChatMessage::create([
            'message' => $message['message'],
            'chat_id' => $chat->id,
        ])) {
            return redirect()->back()->with('info', 'Pertanyaan telah diajukan');
        }

        return redirect()->back()->with('info', 'Pertanyaan gagal diajukan');
    }

    public function resolve(Chat $chat)
    {
        $chat->resolved = true;
        $chat->save();

        return redirect()->back()->with('info', 'Percakapan selesai.');
    }
}
