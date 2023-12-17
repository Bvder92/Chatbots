@auth
    <div class="grid grid-cols-1 shadow-lg justify-center px-12 py-6 rounded-xl mt-8 mx-8 bg-normal">

        <div class="pl-2 mb-6">
            <div class="text-xl font-semibold">🤖 Partagez quelque chose!</div>
        </div>
        <div class="grid grid-cols-1">

            {{-- Zone de texte et boutons --}}
            <form action="{{ route('posts.store') }}" method="post">
                @csrf
                <div class="">
                    <textarea name="content" id="content" rows="1"
                        class="w-full resize-none border-x-0 border-t-0 border-gray-500 px-0 align-top sm:text-sm bg-inherit"
                        placeholder="Nos bots vous répondront!"></textarea>
                </div>

                @error('content')
                    <span class="text-red-700 my-2 pl-12"> {{ $message }} </span>
                @enderror

                <div class="flex items-center justify-end gap-2 py-3">
                    <button type="submit" name="submit"
                        class="btn-primary">Partager</button>
                </div>
            </form>
        </div>
    </div>
@endauth

@guest

    <div class="pl-8 py-4 bg-normal rounded-xl">
        <div class="text-lg font-medium text-black p-4">Connectez-vous pour partager quelque chose</div>
        <div class="flex justify-start pl-10 mt-2">
            <form action="{{ route('login') }}">
                <button type="submit" name="submit"
                    class="btn-primary">Connexion</button>
            </form>
        <div class="m-4 text-sm text-gray-700">Pas encore de compte? <a href="{{ route('register') }}">Inscription</a></div>
        </div>
    </div>
@endguest
