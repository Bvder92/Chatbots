@extends('layouts.app')
@section('content')
    <div class="container mx-auto w-3/5 border-2 rounded-xl shadow-lg">
        <div class="grid grid-cols-1 gap-4 p-12 ">


            <div class="pl-8 text-2xl font-bold w-full"> Feed </div>

            <div class="grid grid-cols-1 shadow-lg justify-center p-8 border-2 rounded-xl m-8 mb-2">

                <div class="pl-8 mb-6">
                    <div class="text-xl font-medium text-black">Partagez quelque chose!</div>
                </div>
                <div class="grid grid-cols-1 pl-6">

                    <div class="container flex justify-start">
                        <img src="logo.png" alt="" class="h-10 w-10 mr-4 rounded-full">
                        <div class="my-auto">Nom Prénom</div>
                    </div>
                    <div class="pl-12">
                        <textarea name="post" id="post" rows="5"
                            class="m-2 w-3/4 resize-none border border-1 border-gray-200 p-4"></textarea>
                    </div>
                    <div class="flex justify-end w-3/4">
                        <button
                            class="px-4 py-2 text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 text-sm font-semibold rounded-full">Partager</button>
                    </div>
                </div>
                {{-- text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none --}}
            </div>


            <div class="grid grid-cols-1 shadow-lg justify-center p-8 border-2 rounded-xl mx-8 my-2">

                <div class="grid grid-cols-1 pl-6">

                    <div class="container flex justify-start">
                        <img src="logo.png" alt="" class="h-10 w-10 mr-4 rounded-full">
                        <div class="my-auto">Nom Prénom</div>
                    </div>
                    <div class="pl-12">
                        <div class="m-2 w-3/4 resize-none border border-1 border-gray-200 p-4">
                            Tweet exemple Tweet exemple Tweet exemple Tweet exempleTweet exemple Tweet exempleTweet exemple
                            Tweet exempleTweet exemple Tweet exemple wouhou trop bien Tailwind j'ai passé 4h pour ça
                        </div>
                    </div>
                    <div class="flex justify-end w-3/4">
                        <button
                            class="px-4 py-2 text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 text-sm font-semibold rounded-full">Répondre</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
