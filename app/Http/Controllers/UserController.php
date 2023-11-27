<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $id){
        return view('users.show', ['user' => $id]);
    }

    public function edit(User $id){
        $editing = true;
        return view('users.show', ['user'=> $id, 'editing'=> $editing]);
    }

    public function update(User $id){
        return redirect()->route('')->with('success','');
    }
}
