    <form action="{{ route('posts.comments.store', $post->id) }}" method="post">
        @csrf
        <div class="flex justify-start pl-14 mt-2 w-3/4 col-span-2">
            <textarea name="content" id="content" cols="40" rows="1" class="border-2 border-gray-200 resize-none"></textarea>
        </div>
        <div class="flex justify-start pl-14 mt-2 w-3/4 col-span-2">
            <button type="submit"
                class="px-4 py-2 text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 text-sm font-semibold rounded-full">Répondre</button>
        </div>
    </form>
    <hr>
    @foreach ($post->comments as $comment)
    <div class="grid grid-cols-2 pl-6">
        <div class="container flex justify-start">
            <img src="{{ asset('logo.png') }}" alt="" class="h-10 w-10 mr-4 rounded-full">
            <div class="my-auto">Nom Prénom</div>
        </div>
        <div class="flex justify-end pr-10">
            <a href="{{ route('posts.edit', $post->id) }}" class="pr-2">Modifier</a>
            <a href="{{ route('posts.show', $post->id) }}" class="pr-2">Voir</a>
            <form action=" {{ route('posts.destroy', $post->id) }}" method="post">
                @csrf
                @method('delete')
                <button>X</button>
            </form>
        </div>
        <div class="pl-12 col-span-2">

            {{-- On vérifie si on est en train de modifier ou juste consulter le post --}}
            {{-- Par défaut, le flag edit est false. --}}
            {{-- Zone de texte et boutons --}}
            <form action="{{ route('posts.update', $post->id) }}" method="post">
                @method('put')
                @csrf
                <div class="pl-12">
                    {{-- <textarea name="content" id="content" rows="5"
                            class="m-2 w-3/4 resize-none border border-1 border-gray-200 p-4">{{ $post->content }}</textarea> --}}
                    <div class="m-2 w3/4 resize-none border-1 border-gray-200 p-4">{{ $post->content }}</div>
                </div>

                <div class="flex justify-start pl-14 mt-2 w-3/4">
                    <button type="submit" name="submit"
                        class="px-4 py-2 text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 text-sm font-semibold rounded-full">Modifier</button>
                </div>
            </form>
        </div>
        <div class="m-2 w-3/4 resize-none border border-1 border-gray-200 p-4">
            {{ $comment->content }}
        </div>
    </div>
    @endforeach
