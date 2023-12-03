<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $validated = request()->validate(
            [
                'name'=> 'required|min:3|max:40',
                'bio' => 'nullable|min:1|max:255',
                'image' => 'image',
            ]
        );

        if(request()->has('image')){
            $imagePath = request()->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;

            //suppression de l'ancienne image:
            Storage::disk('public')->delete($id->image);
        }

        $id->update($validated);
        return view('users.show', ['user'=> $id]);
    }

}
