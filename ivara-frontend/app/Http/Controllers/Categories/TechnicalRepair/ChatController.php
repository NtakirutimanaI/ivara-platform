<?php

namespace App\Http\Controllers\Categories\TechnicalRepair;

use App\Http\Controllers\Controller;

use App\Models\ChatMessage;
use App\Models\Activity;
use App\Events\ActivityCreated;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $userId = auth()->id(); // optional
        $userMsg = $request->message;

        // Save user message
        $userMessage = ChatMessage::create([
            'user_id' => $userId,
            'sender'  => 'user',
            'message' => $userMsg,
        ]);

        // Log activity for user message
        $activity = Activity::create([
            'message' => 'New chat message from user ID: ' . $userId,
            'icon'    => 'fas fa-comment',
        ]);

        // Broadcast the activity to others
        broadcast(new ActivityCreated($activity))->toOthers();

        // Simple keyword-based bot responses
        $botReplies = [];
        if (stripos($userMsg, 'price') !== false) {
            $botReplies[] = "Our pricing depends on the package you choose. Can you tell me more about your needs?";
        } elseif (stripos($userMsg, 'hello') !== false || stripos($userMsg, 'hi') !== false) {
            $botReplies[] = "Hello! How can I assist you today?";
        } else {
            $botReplies[] = "Thank you for your message. Let me understand your needs carefully...";
        }

        // Add contact info
        $botReplies[] = "For further information, please call +250788446936 or email info@ivara.rw";

        // Save each bot reply
        foreach ($botReplies as $reply) {
            ChatMessage::create([
                'user_id' => $userId,
                'sender'  => 'bot',
                'message' => $reply,
            ]);
        }

        return response()->json([
            'user_message' => $userMessage,
            'bot_replies'  => $botReplies,
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'sender'  => 'required|string|in:user,bot',
        ]);

        $chatMessage = ChatMessage::create([
            'user_id' => auth()->id(),
            'sender'  => $validated['sender'],
            'message' => $validated['message'],
        ]);

        return response()->json(['success' => true, 'message' => $chatMessage]);
    }
}
