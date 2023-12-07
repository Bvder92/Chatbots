<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Post $id){

        $comment = new Comment();
        $comment->post_id = $id->id;
        $comment->content = request()->get("content");
        $comment->user_id = auth()->id();

        $comment->save();
        return redirect()->route('posts.show', $id->id)->with('success', "Commentaire publié!");
    }

    public function botStore(Post $id, string $content, User $user) {
        $comment = new Comment();
        $comment->post_id = $id->id;
        $comment->content = $content;
        $comment->user_id = $user->id;
        $comment->save();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
