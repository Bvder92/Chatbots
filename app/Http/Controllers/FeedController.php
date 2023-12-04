<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = auth()->user();

        // Récupérer tous les comptes auquel on est abonné:
        $followingIds = $user->followings()->pluck('id')->all();

        // Tous les posts des comptes auquel on est abonné (ordonnés)
        $posts = Post::whereIn('user_id', $followingIds)->latest();

        // On s'occupe de la recherche
        if(request()->has('search')){
            $posts = $posts->where('content', 'like', '%' . request()->get('search', '') . '%');
        }


        return view('dashboard', [
            'posts' => $posts->paginate(5)
        ]);
    }
}
