<?php

namespace App\Modules\TechnicalRepair;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User; // Or Client model
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;

class MediatorChatController extends Controller
{
    // Open chat page
    public function chat($client_id)
    {
        $client = User::findOrFail($client_id); // or Client::findOrFail
        $messages = ChatMessage::where(function($q) use ($client_id) {
            $q->where('sender_id', Auth::id())
              ->where('receiver_id', $client_id);
        })->orWhere(function($q) use ($client_id) {
            $q->where('sender_id', $client_id)
              ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return view('mediator.chat', compact('client', 'messages'));
    }

    // Send message
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $chat = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $chat
        ]);
    }
}
