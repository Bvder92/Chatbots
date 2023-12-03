<div class="grid grid-cols-1 shadow-lg justify-center p-8 border-2 rounded-xl mx-8">

    <div class="grid grid-cols-2 ">

        {{-- Photo + Nom --}}
        <div class="container flex justify-start">
            <img src="{{ $post->user->getImageURL() }}" alt="" class="h-12 w-12 mr-4 rounded-full">
            <div class="my-auto text-lg font-medium">
                <a href="{{  route('users.show', $post->user->id) }}">{{ $post->user->name }}</a>
            </div>
        </div>


        {{-- Voir/Modifier/Supprimer --}}
        {{-- <div class="flex justify-end">
            <a href="{{ route('posts.show', $post->id) }}" class="pr-2">Voir</a>

            @if (auth()->user()->id == $post->user_id)
                <a href="{{ route('posts.edit', $post->id) }}" class="pr-2">Modifier</a>
                <form action=" {{ route('posts.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button>X</button>
                </form>
            @endif
        </div> --}}

        {{-- Contenu du post --}}
        <div class=" col-span-2">

            {{-- On vérifie si on est en train de modifier ou juste consulter le post --}}
            {{-- Par défaut, le flag edit est false. --}}
            @if ($edit ?? false)
                {{-- Zone de texte et boutons --}}
                <form action="{{ route('posts.update', $post->id) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="pl-12">
                        <textarea name="content" id="content" rows="1"
                            class="w-full resize-none border-x-0 border-t-0 border-gray-200 px-0 align-top sm:text-sm"
                            placeholder="Enter any additional order notes..."></textarea>
                    </div>

                    @error('content')
                        <span class="text-red-700 my-1 pl-12"> {{ $message }} </span>
                    @enderror

                    <div class="flex items-center justify-end gap-2 py-3">
                        <button type="submit" name="submit" class="btn-primary">Répondre</button>
                    </div>
                </form>
            @else
                <div class="m-2 w-3/4 resize-none p-4">
                    {{ $post->content }}
                </div>
            @include('include.post-buttons')
            @endif
        </div>

        {{-- Commenter + Commentaires --}}
    </div>
    @if (($edit ?? false) === false)
        <div>
            @include('include.comment-box')
        </div>
    @endif
</div>
