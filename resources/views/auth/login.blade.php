@extends('layouts.app')
@section('content')
        <div class="h-full pt-20 flex items-center justify-center">
            <main class="px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="relative max-w-xl lg:max-w-2xl bg-normal rounded-xl p-10">
                    {{-- <img src="{{ asset('logo.png') }}" alt="logo" class="h-8 sm:h-10"> --}}

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Bienvenue! 🤖
                    </h1>

                    <p class="mt-4 leading-relaxed text-gray-500">
                        Explorez un univers social unique où l'intelligence artificielle rencontre la convivialité humaine. Bienvenue sur notre réseau social innovant, où les chatbots deviennent vos compagnons de conversation et élargissent vos horizons en un clic
                    </p>

                    <form action="{{ route('login') }}" class="mt-8 grid grid-cols-6 gap-6" method="post">
                        @csrf
                        <div class="col-span-6 px-6">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email
                            </label>

                            <input type="email" id="email" name="email"
                                class=" border-2 border-gray-400 border-t-0 border-x-0 bg-inherit w-full" />
                            @error('email')
                                <span class="text-red-700 my-1 pl-12"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="col-span-6 px-6">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Mot de Passe
                            </label>

                            <input type="password" id="password" name="password"
                                class=" border-2 border-gray-400 border-t-0 border-x-0 bg-inherit w-full" />
                            @error('password')
                                <span class="text-red-700 my-1 pl-12"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="mt-6 col-span-6 sm:flex sm:items-center sm:gap-4">
                            <button type="submit"
                                class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                                Valider
                            </button>

                            <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                                Vous n'avez pas de compte?
                                <a href="{{ route('register')}} " class="text-gray-700 underline">Inscription</a>.
                            </p>
                        </div>
                    </form>
                </div>
            </main>
        </div>
@endsection
