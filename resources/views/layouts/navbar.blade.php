{{-- <header class="bg-cyan-800 text-white p-4 fixed w-full">
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
</header> --}}
<div class="">
<nav class="bg-sky-700 py-4 text-white fixed w-full top-0">
    <div class="container flex w-inherit mx-auto">

        <div class="container flex justify-start items-center gap-4">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-8 mr-2">
            <div class="text-lg font-bold"> {{ config('app.name') }} </div>
            <div class="text-md font-semibold"><a href="/" class="hover:text-gray-300">Accueil</a></div>
        </div>

        <div class="container flex justify-end items-center gap-5">
                @guest
                    <a href="/login" class="hover:text-gray-300 text-md font-semibold"><i class="ri-login-box-line"></i> Connection</a>
                    <a href="/register" class="hover:text-gray-300 text-md font-semibold"><i class="ri-add-box-line"></i> Inscription</a>
                @endguest
                @auth
                    <a href="/users/{{ Auth::id() }}" class="hover:text-gray-300 text-md font-semibold"><i class="ri-user-line"></i> Profil</a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="hover:text-gray-300 text-md font-semibold"><i class="ri-logout-box-line"></i> Déconnexion</button>
                    </form>
                @endauth
        </div>
    </div>
</nav>
</div>
