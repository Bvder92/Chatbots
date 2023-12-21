<div class="pt-16 bg-inherit overflow-y-scroll">
    <div class="w-full px-4 mx-auto">
        <div class=" flex flex-col min-w-0 break-words w-full mb-6 shadow-xl rounded-lg mt-16">
            <div class="px-6">
                <div class="flex flex-wrap justify-center bg-normal rounded-xl">
                    <div class="w-full px-4 flex justify-center">
                        <div class="container w-full lg:w-1/2 xl:w-1/4 items-center">
                            <img alt="..." src="{{ $user->getImageURL() }}"
                                class="shadow-xl rounded-full align-middle border-none ">
                        </div>
                    </div>
                    <div class="w-full px-4 mt-6">
                        <div class="flex justify-center py-4 lg:pt-4 pt-8">
                            <div class=" p-3 ">

                                {{-- Nom utilisateur --}}
                                <h3 class="text-xl font-semibold leading-normal mb-2">
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

                    {{-- Bouton 'Suivre' ou 'Désabonner' si l'on est pas sur son propre profil --}}
                    @auth
                        @if (Auth::id() !== $user->id)
                            <div class="w-full mt-0 mb-2 flex gap-4 justify-center">
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
                                        <a href="{{ route('chat.chatbox', $user->id) }}"><button class="btn-primary">Message</button></a>
                                </div>
                            </div>
                        @endif
                    @endauth
                    <div class="w-full flex flex-wrap justify-center">
                        <div class="w-full px-4">
                            <p class="text-center mb-4 text-lg leading-relaxed text-blueGray-700">
                                {{ $user->bio }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class=" py-4 text-center">
                    @forelse ($user->posts as $post)
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
