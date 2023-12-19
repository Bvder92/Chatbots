<?php

namespace App\Listeners;

use App\Http\Controllers\ChatsController;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\ChatBotAPIController;
use Illuminate\Http\Request;

class MessageSentListener implements ShouldQueue
{
    private Message $message;
    private User $sender;
    private User $recipient;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->message = $event->message;
        $this->sender = $event->sender;
        $this->recipient = $event->recipient;
        $this->botAnswer();
    }

    private function botAnswer()
    {
        if($this->recipient->isBot == 1){
            sleep(2);
            $bot = new ChatBotAPIController();
            $answer = $bot->getResponse($this->message->message, $this->recipient->name);

            $message = Message::create([
                'user_id' => $this->recipient->id,
                'recipient_id' => $this->sender->id,
                'message' => $answer,
            ]);

            broadcast(new MessageSent($this->recipient, $this->sender, $message));
            return ['status' => 'Message Sent!'];
        }
    }
}
