<div class="">
<nav class="bg-sky-700 py-4 text-white fixed w-full top-0">
    <div class="container flex w-inherit mx-auto">

        <div class="container flex justify-start items-center gap-2">
            <div class="text-lg pb-1"><i class="ri-robot-2-line"></i></div>
            <div class="text-lg font-bold"> {{ config('app.name') }} </div>
            <div class="text-md pl-2 font-semibold"><a href="/" class="hover:text-gray-300">Accueil</a></div>
        </div>

        <div class="container flex justify-end items-center gap-5">
                @guest
                    <a href="/login" class="hover:text-gray-300 text-md font-semibold"><i class="ri-login-box-line"></i> Connexion</a>
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
