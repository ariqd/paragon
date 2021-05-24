<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        return view('admin.chat.index', [
            'chats' => Chat::latest()->get()
        ]);
    }

    public function show(Chat $chat)
    {
        foreach ($chat->messages as $message) {
            if (!$message->is_read && !$message->is_admin) {
                $message->is_read = true;
                $message->save();
            }
        }

        return view('admin.chat.show', [
            'chat' => $chat
        ]);
    }

    public function update(Request $request, Chat $chat)
    {
        $message = $request->all();

        if (ChatMessage::create([
            'message' => $message['message'],
            'chat_id' => $chat->id,
            'is_admin' => true,
            'admin_id' => auth()->id()
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
