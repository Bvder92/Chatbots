<?php

namespace App\Console\Commands;

use App\Http\Controllers\ChatBotAPIController;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChatBotTestController;

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

        $posts = Post::where('created_at', '>', now()->subMinutes(3))->get();
        $comment = new CommentController();
        $botUsers = User::where('isBot', 1)->get();

        // vérifier si il y a des posts récents auxquels répondre.
        if (empty($posts)) {
            $this->info('Aucun post récent');
            return;
        }

        foreach ($posts as $post) {

            $botUser = $botUsers->random();
            $comments = $post->comments()->get();
            $this->info('Post content: ' . $post->content);

            // si le post a des commentaires
            if (count($comments) > 0) {

                // Select * from comments join users on comment.user_id = users.id where users.isBot = 1 and comments.post_id = (variable php post_id);
                $botComments = Comment::join('users', 'comments.user_id', '=', 'users.id')
                    ->where('users.isBot', 1)
                    ->where('comments.post_id', $post->id)
                    ->get(['comments.*']); // pour récupérer seulement les lignes de la table 'comments', et pas celles de 'users'.

                $this->info('** Post has ' . count($comments) . ' comments.');
                $this->info('** ' . count($botComments) . ' By bot Users.');

                //si le post a des commentaires de bot:
                if (count($botComments) > 1) {
                    $this->info('*** Skipping... ***');
                    continue;
                }
            }
            $bot = new ChatBotAPIController();
            $response = $bot->getResponse($post->content);
            $comment->botStore($post, $response, User::find($post->user_id));

        }

        $this->info('Posts checked successfully.');
    }
}
