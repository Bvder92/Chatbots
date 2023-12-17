<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Controllers\CommentController;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\ChatBotAPIController;
use Illuminate\Support\Facades\Log;

class PostEventListener
{
    /**
     * Create the event listener.
     */

     public $post;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        Log::info("Event triggered!");
        $this->post = $event->post;

        $comment = new CommentController();
        $botUsers = User::where('isBot', 1)->get();
        Log::info("Bot Users", ['botUsers:' => $botUsers]);


        if ($botUsers->count() == 0) {
             return;
        }

        $botUser = $botUsers->random();
        $bot = new ChatBotAPIController();
        $response = $bot->getResponse($this->post->content, $botUser->name);

        if($response === "Je ne comprends pas... Pouvez-vous reformuler ?"){
            return;
        }

        $comment->botStore($this->post, $response, $botUser);

    }
}
