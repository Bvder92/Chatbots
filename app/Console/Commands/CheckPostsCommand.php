<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChatBotTestController;
use App\Models\User;

class CheckPostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-posts-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Interroger le chatbot python';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('created_at', '>', now()->subMinutes(5))->get();
        $comment = new CommentController();
        $bot = new ChatBotTestController();

        if(empty($posts)){
            $this->info('Aucun post récent');
            return;
        }

        foreach ($posts as $post) {
            $this->info('Post content: ' . $post->content);
            $bot = new ChatBotTestController();
            $response = $bot->chatbot2($post->content);
            $comment->botStore($post, $response, User::find($post->user_id));

        }

        $this->info('Posts checked successfully.');
    }
}
