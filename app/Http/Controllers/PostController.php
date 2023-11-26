<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(){

        $validated = request()->validate([
            'content' => 'required|min:2|max:255'
        ]);

        Post::create($validated);

        // $post = new Post([
        //     'content' => request()->get('content','')
        // ]);
        // $post->save();

        return redirect()->route('dashboard')->with('success', ' Votre Post à bien été publié!');
    }

    public function show(Post $id){

        return view('posts.show', [
            'post' => $id
        ]);
    }

    public function edit(Post $id){

        $edit = true;
        return view('posts.show', [
            'post' => $id,
            'edit' => $edit
        ]);
    }

    public function update(Post $id){

        $validated = request()->validate([
            'content' => 'required|min:2|max:255'
        ]);

        $id->update($validated);

        // $id->content = request()->get('content', '');
        // $id->save();

        return view('posts.show', ['post' => $id])->with('success', "Post mis à jour avec succès");
    }

    public function destroy(Post $id){

        $id->delete();

        return redirect()->route('dashboard')->with('success', ' Votre Post à bien été supprimé!');
    }
}
