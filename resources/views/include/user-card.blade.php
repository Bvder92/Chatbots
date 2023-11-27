<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
<link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

<section class="pt-16">
    <div class="w-full px-4 mx-auto">
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16">
            <div class="px-6">
                <div class="flex flex-wrap justify-center">
                    <div class="w-full px-4 flex justify-center">
                        <div class="relative">
                            <img alt="..." src="{{ asset('logo.png') }}"
                                class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
                        </div>
                    </div>
                    <div class="w-full px-4 mt-24">
                        <div class="flex justify-center py-4 lg:pt-4 pt-8">
                            <div class=" p-3 ">
                                <h3 class="text-xl font-semibold leading-normal text-blueGray-700 mb-2">
                                    @if ($editing ?? false)
                                    <form action="">
                                        <input type="text" value="{{ $user->name }}" for>
                                    </form>

                                    @else
                                    {{ $user->name }}
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-4 text-center">
                        <div class="flex justify-center py-4 lg:pt-4 pt-8">
                            <div class="mr-4 p-3 text-center">
                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                    22
                                </span>
                                <span class="text-sm text-blueGray-400">Abonnements</span>
                            </div>
                            <div class="mr-4 p-3 text-center">
                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                    10
                                </span>
                                <span class="text-sm text-blueGray-400">Abonnés</span>
                            </div>
                            <div class="lg:mr-4 p-3 text-center">
                                <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                                    {{ $user->posts()->count() }}
                                </span>
                                <span class="text-sm text-blueGray-400">Posts</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class=" mt-0 mb-2 flex gap-4 justify-center">
                        <div class="">
                            <button class="btn-primary">Suivre</button>
                        </div>
                        <div class="">
                            <button class="btn-primary">Message</button>
                        </div>
                    </div>
                    @auth
                    @if (Auth::id() === $user->id)
                    <div class="mb-2 text-blueGray-600">
                    <a href="{{ route('users.edit', $user->id) }}">Modifier</a>
                    </div> @endif
                    @endauth
                </div>
                <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-9/12 px-4">
                            @if ($editing ?? false)
                            <form action="">
                                <input type="textarea" value="{{ $user->id }}">
                                <button type="submit" class="btn-primary">Sauvegarder</button>
                            </form>
                            @else
                            <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                                An artist of considerable range, Jenna the name taken
                                by Melbourne-raised, Brooklyn-based Nick Murphy
                                writes, performs and records all of his own music,
                                giving it a warm, intimate feel with a solid groove
                                structure. An artist of considerable range.
                            </p> @endif
                        </div>
                    </div>
                </div>
                <div class="mt-10 py-10 text-center">
                        @forelse ($user->posts as $post)
                            @include('include.post-card')
                        @empty
                            <p class="text-center my-3">Aucun résultat</p>
                        @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
