<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ChatBotAPIController extends Controller
{

    public function getResponse(string $message, string $bot_name)
    {
        $client = new Client();

        $url = 'python:5000/api/chatbot';

        $data = [
            'message' => $message,
            'bot_name' => $bot_name,
        ];

        try {
            $response = $client->post($url, [
                'json' => $data,
            ]);

            // Récupérer le contenu de la réponse
            $contenu = $response->getBody()->getContents();

            $botResponse = json_decode($contenu, true);
            $botResponse = $botResponse['response'] ?? "Erreur: aucune réponse";
            return $botResponse;

        } catch (\Exception $e) {
            return response()->json(['err' => $e->getMessage()], 500);
        }
    }
}

