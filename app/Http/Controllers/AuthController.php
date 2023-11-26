<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function store(){
        $validated = request()->validate([
            'email'=> 'required|email|unique:users,email',
            'name' => 'required|min:2|max:40',
            'password' => 'required|confirmed', // confirmation automatique
        ]);

        User::create([
            'email'=> $validated['email'],
            'name'=> $validated['name'],
            'password'=> Hash::make($validated['password']),
        ]);

        return redirect()->route('dashboard')->with('success','Votre compte a bien été créé');
    }

    public function login(){
        return view('auth.login');
    }

    public function authenticate(){

        $validated = request()->validate([
            'email'=> 'required|email|',
            'password' => 'required', // confirmation automatique
        ]);

        if(auth()->attempt($validated)){
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Connexion réussie');
        }

        return redirect()->route('login')->withErrors([
            'email' => "Combinaison email mot de passe inconnue"
        ]);
    }

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Vous avez été déconnecté');
    }
}
