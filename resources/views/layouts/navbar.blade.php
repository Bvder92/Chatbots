<header class="bg-cyan-800 text-white p-4">
    <div class="container mx-auto flex items-center justify-start">
        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-8 mr-6">
        <div class="mr-8 text-lg font-medium"> {{ config('app.name') }} </div>

        <!-- Liens de navigation -->
        <nav class="flex space-x-4">
            <a href="/" class="hover:text-gray-300">Accueil</a>
            @guest
            <a href="/login" class="hover:text-gray-300">Connection</a>
            <a href="/register" class="hover:text-gray-300">Inscription</a>
            @endguest
            @auth
            <a href="/profile" class="hover:text-gray-300">Profil</a>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit">Déconnexion</button>
            </form>
            @endauth
        </nav>
    </div>
</header>
