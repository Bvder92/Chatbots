<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

<div class="pt-16">
    <div class="w-full px-4 mx-auto">
        <div class=" flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16">
            <div class="px-6">
                <div class="flex flex-wrap justify-center">
                    <div class="w-full px-4 flex justify-center">
                        <div class="">
                            <img alt="..." src="{{ $user->getImageURL() }}"
                                class="shadow-xl rounded-full h-auto align-middle border-none  -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                        </div>
                    </div>
                    <div class="w-full px-4 mt-24">
                        <div class="flex justify-center py-4 lg:pt-4 pt-8">
                            <div class=" p-3 ">

                                    {{-- Nom utilisateur --}}
                                <h3 class="text-xl font-semibold leading-normal text-blueGray-700 mb-2">
                                        {{ $user->name }}
                                </h3>

                                    {{-- bouton 'Modifier' --}}
                                @if (Auth::id() === $user->id)
                                    <div class="text-sm text-gray-600 text-center">
                                        <a href="{{ route('users.edit', $user->id) }}">Modifier</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-4 text-center">
                        <div class="flex justify-center py-4 lg:pt-2">
                            <div class="mr-4 px-3 text-center">
                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                    {{ $user->followings()->count() }}
                                </span>
                                <span class="text-sm text-blueGray-400">Abonnements</span>
                            </div>
                            <div class="mr-4 px-3 text-center">
                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                    {{ $user->followers()->count() }}
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

                {{-- Bouton 'Suivre' ou 'Désabonner' si l'on est pas sur son propre profil --}}
                <div class="">
                    @auth
                    @if (Auth::id() !== $user->id)
                    <div class=" mt-0 mb-2 flex gap-4 justify-center">
                        <div class="">

                            @if (Auth::user()->follows($user))
                                <form action="{{ route('users.unfollow', $user->id) }}" method="post">
                                    @csrf
                                    <button class="btn-primary" type="submit">Se désabonner</button>
                                </form>
                            @else
                                <form action="{{ route('users.follow', $user->id) }}" method="post">
                                    @csrf
                                    <button class="btn-primary" type="submit">Suivre</button>
                                </form>
                            @endif

                        </div>
                        <div class="">
                            <button class="btn-primary">Message</button>
                        </div>
                    </div>
                    @endif
                    @endauth
                </div>
                <div class="mt-4 py-4 border-t border-blueGray-200 text-center">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-9/12 px-4">
                            <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                            {{ $user->bio }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 py-4 text-center">
                        @forelse ($user->posts as $post )
                           <div class="py-1">
                                @include('include.post-card')
                            </div>
                        @empty
                            <p class="text-center my-3">Aucun résultat</p>
                        @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
