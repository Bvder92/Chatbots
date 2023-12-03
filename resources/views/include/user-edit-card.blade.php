<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

<section class="pt-16">
    <div class="w-full px-4 mx-auto">

        <form action=" {{ route('users.update', $user->id) }} " method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16">
            <div class="px-6">
                <div class="flex flex-wrap justify-center">
                    <div class="w-full px-4 flex justify-center">
                        <div class="relative">
                            <img alt="..." src="{{ $user->getImageURL() }}"
                                class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                        </div>
                    </div>
                    <div class="w-full px-4 mt-24">
                        <div class="flex justify-center py-4 lg:pt-4 pt-8">
                            <div class=" p-3 ">

                                    {{-- Modifier Image Profil --}}
                                    <input type="file" name="image" id="image" class="m-4 text-sm">
                                        @error('name')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror

                                    {{-- Nom utilisateur --}}
                                <h3 class="text-xl font-semibold leading-normal text-blueGray-700 mb-2">
                                        <input type="text" name="name" value="{{ $user->name }}" class="m-4">
                                        @error('name')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                </h3>

                                    {{-- bouton 'Modifier' --}}
                                @if (Auth::id() === $user->id)
                                    <div class="text-sm text-gray-600 text-center">
                                            <a href="{{ route('users.show', $user->id) }}">Annuler</a>
                                            <button class="btn-primary">Sauvegarder</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-4 text-center">
                        <div class="flex justify-center py-4 lg:pt-2">
                            <div class="mr-4 px-3 text-center">
                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                    22
                                </span>
                                <span class="text-sm text-blueGray-400">Abonnements</span>
                            </div>
                            <div class="mr-4 px-3 text-center">
                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                    10
                                </span>
                                <span class="text-sm text-blueGray-400">Abonnés</span>
                            </div>
                            <div class="lg:mr-4 px-3 text-center">
                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                    {{ $user->posts()->count() }}
                                </span>
                                <span class="text-sm text-blueGray-400">Posts</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 py-4 border-t border-blueGray-200 text-center">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-9/12 px-4">
                                <input type="textarea" value="{{ $user->bio }}" name="bio">
                                    @error('bio')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-4 py-4 text-center">
                        @forelse ($user->posts as $post)
                        <div class="py-1">
                            @include('include.post-card')
                        </div>
                        @empty
                            <p class="text-center my-3">Aucun résultat</p> @endforelse
                </div>
            </div>
        </div>
        </form>
    </div>
</section>
