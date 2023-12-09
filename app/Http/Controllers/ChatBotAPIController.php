<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

// pas statique car à terme, on aura plusieurs chatbot, et un controlleur sera associé
// à un chatbot par un attribut initialisé avec un constructeur.
class ChatBotAPIController extends Controller
{
    // return
    public function getResponse(string $message)
    {
        // Créer une instance du client Guzzle
        $client = new Client();

        // URL du service Python Flask
        $url = 'python:5000/api/chatbot';

        // Données à envoyer dans la requête POST
        $data = [
            'message' => $message,
        ];

        try {
            // Effectuer la requête HTTP POST vers le service Python
            $response = $client->post($url, [
                'json' => $data, // Utiliser 'json' pour envoyer les données en JSON
            ]);

            // Récupérer le contenu de la réponse
            $contenu = $response->getBody()->getContents();

            $botResponse = json_decode($contenu, true);
            $botResponse = $botResponse['response'] ?? "Erreur: aucune réponse";
            return $botResponse;

            // Exemple : retourner le contenu dans la réponse de votre Laravel
        } catch (\Exception $e) {
            // Gérer les erreurs, par exemple en renvoyant un message d'erreur
            return response()->json(['err' => $e->getMessage()], 500);
        }
    }
}

