<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(){

        request()->validate([
            'post-form' => 'required|min:2|max:255'
        ]);

        $post = new Post([
            'content' => request()->get('post-form','')
        ]);
        $post->save();

        return redirect()->route('dashboard')->with('success', ' Votre Post à bien été publié!');
    }

    public function destroy($id){

        $post = Post::where('id', $id)->first();
        $post->delete();

        return redirect()->route('dashboard')->with('success', ' Votre Post à bien été supprimé!');
    }
}
