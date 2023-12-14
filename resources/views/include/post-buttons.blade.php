<div class="grid grid-cols-2 px-4">

    <div>

        <span class="inline-flex overflow-hidden rounded-md border shadow-sm">

            {{-- Boutons Voir/Modifier/Supprimer --}}
            <a href="{{ route('posts.show', $post->id) }}"
                class="p-1 bg-inherit inline-block border-e text-gray-700 hover:bg-gray-50 focus:relative"><i
                    class="ri-search-eye-line"></i></a>

            @if (auth()->user()->id == $post->user_id)
                <a href="{{ route('posts.edit', $post->id) }}"
                    class="p-1 bg-inherit inline-block border-e text-gray-700 hover:bg-gray-50 focus:relative"><i
                        class="ri-file-edit-line"></i></a>

                {{-- Form ici pour la méthode 'delete' --}}
                <form action=" {{ route('posts.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button title="Supprimer"
                        class="p-1 bg-inherit inline-block border-e text-gray-700 hover:bg-gray-50 focus:relative"><i
                            class="ri-delete-bin-line"></i></button>
                </form>
            @endif
        </span>

    </div>

    <div class="flex justify-end text-sm"><i class="ri-time-line"></i>{{ date_format($post->created_at, 'd/m/Y') }}
    </div>
</div>
