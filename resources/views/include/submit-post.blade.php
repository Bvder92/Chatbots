@auth
    <div class="grid grid-cols-1 shadow-lg justify-center p-8 border-2 rounded-xl mt-8 mx-8">

        <div class="pl-8 mb-6">
            <div class="text-xl font-medium text-black">Partagez quelque chose!</div>
        </div>
        <div class="grid grid-cols-1 pl-6">

            {{-- Photo Profil et Nom --}}
            <div class="container flex justify-start">
                <img src="{{ asset('logo.png') }}" alt="" class="h-10 w-10 mr-4 rounded-full">
                <div class="my-auto">{{ auth()->user()->name }}</div>
            </div>

            {{-- Zone de texte et boutons --}}
            <form action="{{ route('posts.store') }}" method="post">
                @csrf
                <div class="pl-12">
                    <textarea name="content" id="content" rows="5"
                        class="m-2 w-3/4 resize-none border border-1 border-gray-200 p-4"></textarea>
                </div>

                @error('content')
                    <span class="text-red-700 my-1 pl-12"> {{ $message }} </span>
                @enderror

                <div class="flex justify-start pl-14 mt-2 w-3/4">
                    <button type="submit" name="submit"
                        class="px-4 py-2 text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 text-sm font-semibold rounded-full">Partager</button>
                </div>
            </form>
        </div>
    </div>
@endauth

@guest

    <div class="pl-8 mb-6">
        <div class="text-xl font-medium text-black p-4">Connectez-vous pour partager quelque chose</div>
        <div class="flex justify-start pl-14 mt-2 w-3/4">
            <form action="{{ route('login') }}">
                <button type="submit" name="submit"
                    class="px-4 py-2 text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 text-sm font-semibold rounded-full">Connexion</button>
            </form>
        </div>
        <div class="m-4">Pas encore de compte? <a href="{{ route('register') }}">Inscription</a></div>
    </div>
@endguest
