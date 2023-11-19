@extends('layouts.app')
@section('content')
    <div class="container mx-auto w-3/5 border-2 rounded-xl shadow-lg">
        <div class="grid grid-cols-1 gap-4 p-12 ">

            @include('include.success-message')
            @include('include.submit-post')

            @foreach ($posts as $post)
                <div class="grid grid-cols-1 shadow-lg justify-center p-8 border-2 rounded-xl mx-8">

                    <div class="grid grid-cols-1 pl-6">

                        <div class="container flex justify-start">
                            <img src="logo.png" alt="" class="h-10 w-10 mr-4 rounded-full">
                            <div class="my-auto">Nom Prénom</div>
                        </div>
                        <div class="pl-12">
                            <div class="m-2 w-3/4 resize-none border border-1 border-gray-200 p-4">
                                {{ $post->content }}
                            </div>
                        </div>
                        <div class="flex justify-start pl-14 mt-2 w-3/4">
                            <button
                                class="px-4 py-2 text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 text-sm font-semibold rounded-full">Répondre</button>
                        </div>
                    </div>
                </div>
        @endforeach
        </div>
    @endsection
