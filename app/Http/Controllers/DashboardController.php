<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC');

        // On s'occupe de la recherche
        if(request()->has('search')){
            $posts = $posts->where('content', 'like', '%' . request()->get('search', '') . '%');
        }


        return view('dashboard', [
            'posts' => $posts->paginate(5)
        ]);
    }
}
