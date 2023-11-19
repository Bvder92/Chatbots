<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $post = new Post([
        //     'content' => 'Un autre exemple. Cette fois c\'est bien un Post.',
        //     'likes' => 200
        // ]);
        // $post->save();
        return view('dashboard', [
            'posts' => Post::orderBy('created_at','DESC')->get()
        ]);
    }
}
