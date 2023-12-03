<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function follow(User $user){

        // La personne qui va s'abonner est l'utilisateur connecté:
       $follower = auth()->user();
       // Append to the list of following
       $follower->followings()->attach($user);

       return redirect()->route('users.show', $user->id)->with('success','Vous êtes abonné');
    }
    public function unfollow(User $user){

        // La personne qui va s'abonner est l'utilisateur connecté:
       $follower = auth()->user();
       // Remove from list of following
       $follower->followings()->detach($user);

       return redirect()->route('users.show', $user->id)->with('success','Vous êtes désabonné');
    }
}
