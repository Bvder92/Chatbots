<?php

namespace App\Http\Controllers;

use App\Events\PostEvent;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(){

        $validated = request()->validate([
            'content' => 'required|min:2|max:500'
        ]);
        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);
        broadcast(new PostEvent($post) )->toOthers();

        return redirect()->route('dashboard')->with('success', 'Votre Post a bien été publié!');
    }

    public function show(Post $id){

        return view('posts.show', [
            'post' => $id
        ]);
    }

    public function edit(Post $id){

        // si l'utilisateur n'est pas le créateur du post
        if(auth()->user()->id !== $id->user_id){
           abort(404, "non");
        }

        $edit = true;
        return view('posts.show', [
            'post' => $id,
            'edit' => $edit
        ]);
    }

    public function update(Post $id){

        // si l'utilisateur n'est pas le créateur du post
        if(auth()->user()->id !== $id->user_id){
           abort(404, "non");
        }

        $validated = request()->validate([
            'content' => 'required|min:2|max:500'
        ]);

        $id->update($validated);

        // $id->content = request()->get('content', '');
        // $id->save();

        return view('posts.show', ['post' => $id])->with('success', "Post mis à jour avec succès");
    }

    public function destroy(Post $id){

        // si l'utilisateur n'est pas le créateur du post
        if(auth()->user()->id !== $id->user_id){
           abort(404, "non");
        }
        $id->delete();

        return redirect()->route('dashboard')->with('success', 'Votre Post a bien été supprimé!');
    }
}
