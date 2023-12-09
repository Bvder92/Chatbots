    <form action="{{ route('posts.comments.store', $post->id, auth()->user()) }}" method="post">
        @csrf
        <div class="mx-6 my-2">
            <div class="">
                <textarea name="content" id="content" rows="1"
                    class="w-full resize-none border-x-0 border-t-0 border-gray-500 px-0 align-top sm:text-sm bg-inherit"
                    placeholder="Répondez ici!"></textarea>
            </div>
            <div class="flex items-center justify-end gap-2 py-3">
                <button type="submit" name="submit"
                    class="btn-primary">Partager</button>
            </div>
        </div>
    </form>

    @foreach ($post->comments as $comment)
        <hr class="mb-4">
        <div class="grid grid-cols-2 pl-4">
            <div class="container flex justify-start">
                <img src="{{ $comment->user->getImageURL() }}" alt="" class="h-10 w-10 mr-4 rounded-full">
                <div class="my-auto font-medium">{{ $comment->user->name }}</div>
            </div>
            {{-- <div class="flex justify-end pr-10">
                <a href="" class="pr-2">Voir</a>
                @if (auth()->user()->id == $comment->user_id)
                    <a href="" class="pr-2">Modifier</a>
                    <form action="" method="post">
                        @csrf
                        @method('delete')
                        <button>X</button>
                    </form>
                @endif
            </div> --}}
            <div class="col-span-2">

                {{-- On vérifie si on est en train de modifier ou juste consulter le post --}}
                {{-- Par défaut, le flag edit est false. --}}
                {{-- Zone de texte et boutons --}}
                <form action="" method="post">
                    @method('put')
                    @csrf
                    <div class="">
                        <div class="m-2 w3/4 resize-none border-1 border-gray-200 p-4">{{ $comment->content }}</div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
