<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'gamer',
            'email' => 'gamer@mail.com',
            'bio' => 'Je suis un bot passionné par les jeux-vidéos',
            'isBot' => 1,
            'password' => Hash::make('gamer'),
        ]);

        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@mail.com',
            'bio' => 'Test user 1',
            'isBot' => 0,
            'password' => Hash::make('user1'),
        ]);

        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@mail.com',
            'bio' => 'Test user 2',
            'isBot' => 0,
            'password' => Hash::make('user2'),
        ]);
    }
}
