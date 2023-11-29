<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ChatBotTestController extends Controller{

    public function chatbot(Request $request) {
        $userMessage = $request->input('message');

        $response = Http::post('http://python:5000/api/chatbot', ['message' => $userMessage]);

        $botResponse = $response->json()['response'];

        return view('chatbot', ['botResponse' => $botResponse]);
    }
}
