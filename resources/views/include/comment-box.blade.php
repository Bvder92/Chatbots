    <form action="{{ route('posts.comments.store', $post->id) }}" method="post">
        @csrf
        <div class="container flex mb-4">
            <div class="flex pl-14 mt-2 w-3/4">
                <textarea name="content" id="content" rows="1" class="w-full border-2 border-gray-200 resize-none"></textarea>
            </div>
            <div class="flex pl-14 mt-2 w-1/4">
                <button type="submit"
                    class="px-4 py-2 text-white bg-sky-500 hover:bg-sky-600 active:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 text-sm font-semibold rounded-full">Répondre</button>
            </div>
        </div>
    </form>

    @if (count($post->comments) > 0)
        <hr class="mb-4">
    @endif
    @foreach ($post->comments as $comment)
        <div class="grid grid-cols-2 pl-6">
            <div class="container flex justify-start">
                <img src="{{ asset('logo.png') }}" alt="" class="h-10 w-10 mr-4 rounded-full">
                <div class="my-auto">Nom Prénom</div>
            </div>
            <div class="flex justify-end pr-10">
                <a href="" class="pr-2">Modifier</a>
                <a href="" class="pr-2">Voir</a>
                <form action="" method="post">
                    @csrf
                    @method('delete')
                    <button>X</button>
                </form>
            </div>
            <div class="pl-12 col-span-2">

                {{-- On vérifie si on est en train de modifier ou juste consulter le post --}}
                {{-- Par défaut, le flag edit est false. --}}
                {{-- Zone de texte et boutons --}}
                <form action="" method="post">
                    @method('put')
                    @csrf
                    <div class="pl-12">
                        {{-- <textarea name="content" id="content" rows="5"
                            class="m-2 w-3/4 resize-none border border-1 border-gray-200 p-4">{{ $post->content }}</textarea> --}}
                        <div class="m-2 w3/4 resize-none border-1 border-gray-200 p-4">{{ $comment->content }}</div>
                    </div>

                </form>
            </div>
        </div>
    @endforeach
