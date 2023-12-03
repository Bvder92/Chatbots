@extends('layouts.app')
@section('content')
    <section class="bg-white">
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
            <aside class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6">
                <img alt="Pattern"
                    src="https://images.unsplash.com/photo-1605106702734-205df224ecce?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                    class="absolute inset-0 h-full w-full object-cover" />
            </aside>

            <main class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="max-w-xl lg:max-w-3xl">
                    {{-- <img src="{{ asset('logo.png') }}" alt="logo" class="h-8 sm:h-10"> --}}

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Bienvenue! 🤖
                    </h1>

                    <p class="mt-4 leading-relaxed text-gray-500">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eligendi nam
                        dolorum aliquam, quibusdam aperiam voluptatum. ChatGPT va nous générer une phrase d'accroche tkt
                    </p>

                    <form action="{{ route('login') }}" class="mt-8 grid grid-cols-6 gap-6" method="post">
                        @csrf
                        <div class="col-span-6">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email
                            </label>

                            <input type="email" id="email" name="email"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
                            @error('email')
                                <span class="text-red-700 my-1 pl-12"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Mot de Passe
                            </label>

                            <input type="password" id="password" name="password"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" />
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
                                <a href="#" class="text-gray-700 underline">Inscription</a>.
                            </p>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>
@endsection
