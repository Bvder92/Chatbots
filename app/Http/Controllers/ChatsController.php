<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if (request()->has('search')) {
            $search = request()->get('search', '');
            $users = User::where('name', 'like', '%' . $search . '%')->get();
        } else {
            $users = $user->followings()->get();
        }

        // suppression de l'utilisateur actuel:
        $userToRemove = $users->where('id', $user->id)->first();

        if ($userToRemove) {
            $users = $users->reject(function ($item) use ($userToRemove) {
                return $item->id === $userToRemove->id;
            });
        }

        return view('chat.index', [
            'users' => $users,
            'page' => 'chat',
        ]);
    }
    public function chatbox($recipient_id)
    {
        $user = Auth::user();
        $recipient = User::find($recipient_id);
        return view('chat.chatbox', ['recipient' => $recipient, 'user' => $user]);
    }

    public function fetchMessages($recipient_id)
    {
        $user = Auth::user();

        $first = DB::table('messages')->where('user_id', $user->id)->where('recipient_id', $recipient_id);
        $second = DB::table('messages')->where('user_id', $recipient_id)->where('recipient_id', $user->id)->union($first)->orderBy('created_at', 'asc');
        $second = $second->get();
        return $second;

    }

    public function sendMessage(Request $request)
    {

        $validated = $request->validate([
            'recipient' => 'required',
            'message' => 'required',
        ]);

        $user = Auth::user();
        $recipient = User::find($request->input('recipient')['id']);

        $message = Message::create([
            'user_id' => $user->id,
            'recipient_id' => $recipient->id,
            'message' => $validated['message']
        ]);

        broadcast(new MessageSent($user, $recipient, $message))->toOthers();
        return ['status' => 'Message Sent!' /* 'user' => $user, 'recipient' => $recipientId, 'msg'=> $text */];
    }
}

