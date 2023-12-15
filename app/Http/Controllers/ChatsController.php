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
    //Add the below functions
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if(request()->has('search')){
            //$users = $posts->where('content', 'like', '%' . request()->get('search', '') . '%');
            $users = User::where('name', 'like', '%' . request()->get('search', '') . '%');
            return view('chat.index', [
                'users'=> $users,
                'page' => 'chat',
            ]);
        }

        $users = User::whereIn('id', function ($query) use ($user) {
            $query->select('user_id')
            ->from('messages')
            ->where('recipient_id', $user->id) // l'utilisateur est l'envoyeur
            ->orwhere('user_id', $user->id); // l'utilisateur est le receveur
        })->get();

        // suppression de l'utilisateur actuel:
        $userToRemove = $users->where('id', $user->id)->first();

        if ($userToRemove) {
            $users = $users->reject(function ($item) use ($userToRemove) {
                return $item->id === $userToRemove->id;
            });
        }

        return view('chat.index', [
            'users'=> $users,
            'page'=> 'chat',
        ]);
    }
    public function chatbox($recipient_id)
    {
        $user = Auth::user();
        $recipient = User::find($recipient_id);
        return view('chat.chatbox', ['recipient'=> $recipient, 'user' => $user]);
    }

    public function fetchMessages($recipient_id)
    {
        $user = Auth::user();

        // $users = User::whereIn('id', function ($query) use ($user) {
        //     $query->select('user_id')
        //     ->from('messages')
        //     ->where('recipient_id', $user->id) // l'utilisateur est l'envoyeur
        //     ->orwhere('user_id', $user->id); // l'utilisateur est le receveur
        // })->get();

        $first = DB::table('messages')->where('user_id', $user->id)->where('recipient_id', $recipient_id);
        $second = DB::table('messages')->where('user_id', $recipient_id)->where('recipient_id', $user->id)->union($first)->orderBy('created_at','asc');
        $second = $second->get();
        return $second;

        // messages sent by User to recipient:
        //$sentMessages = $user->sentMessages()->where('recipient_id', $recipient_id)->with('sender', 'recipient')->get();

        // messages received by User from recipient:
        //$receivedMessages = $user->receivedMessages()->where('user_id', $recipient_id)->with('sender', 'recipient')->get();

        //$merged = $sentMessages->merge($receivedMessages);
        //return $merged->sortBy('updated_at');
        //return $merged;
    }

    public function sendMessage(Request $request)
    {

        $validated = $request->validate([
            'recipient'=> 'required',
            'message'=> 'required',
        ]);

        $user = Auth::user();
        $recipient = User::find($request->input('recipient')['id']);

        $message = Message::create([
            'user_id' => $user->id,
            'recipient_id' => $recipient->id,
            'message' => $validated['message']
        ]);

        broadcast(new MessageSent($user, $recipient, $message))->toOthers();
        return ['status' => 'Message Sent!' /* 'user' => $user, 'recipient' => $recipientId, 'msg'=> $text */ ] ;
    }
}

