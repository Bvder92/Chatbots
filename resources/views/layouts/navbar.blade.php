<header class="bg-cyan-800 text-white p-4">
    <div class="container mx-auto flex items-center justify-start">
        <img src="logo.png" alt="Logo" class="h-8 w-8 mr-6">
        <div class="mr-8 text-lg font-medium"> {{ config('app.name') }} </div>

        <!-- Liens de navigation -->
        <nav class="flex space-x-4">
            <a href="/" class="hover:text-gray-300">Accueil</a>
            <a href="/profile" class="hover:text-gray-300">Profil</a>
        </nav>
    </div>
</header>
