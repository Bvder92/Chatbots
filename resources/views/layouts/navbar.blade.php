<header class="bg-cyan-800 text-white p-4 fixed w-full">
    <div class="container mx-auto flex items-center justify-start">

        <div class="container flex justify-start items-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-8 mr-6">
            <div class="mr-4 text-lg font-bold"> {{ config('app.name') }} </div>
            <div class="mx-4 text-md font-medium"><a href="/" class="hover:text-gray-300">Accueil</a></div>
        </div>

        <!-- Liens de navigation -->
        <div class="container flex justify-end">
            <nav class="flex space-x-4 justify-center">
                @guest
                    <a href="/login" class="hover:text-gray-300">Connection</a>
                    <a href="/register" class="hover:text-gray-300">Inscription</a>
                @endguest
                @auth
                    <a href="/users/{{ Auth::id() }}" class="hover:text-gray-300">Profil</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">Déconnexion</button>
                    </form>
                @endauth
            </nav>
        </div>

    </div>
</header>
