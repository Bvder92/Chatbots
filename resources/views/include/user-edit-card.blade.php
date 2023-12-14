<section class="pt-16">
    <div class="w-full px-4 mx-auto">

        <form action=" {{ route('users.update', $user->id) }} " method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-xl rounded-lg mt-16">
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

                                    {{-- Modifier Image Profil --}}
                                    <input type="file" name="image" id="image"
                                        class="m-4 text-sm border-t-0 border-x-0">
                                    @error('name')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror

                                    {{-- Nom utilisateur --}}
                                    <h3 class="text-xl font-semibold leading-normal mb-2">
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="m-4 text-center border-2 border-gray-500 border-t-0 border-l-0 border-r-0 bg-inherit">
                                        @error('name')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </h3>

                                    {{-- bouton 'Sauvegarder'/'Annuler' --}}
                                    <div class="text-sm text-gray-600 text-center space-x-4">
                                        <a href="{{ route('users.show', $user->id) }}">Annuler</a>
                                        <button class="btn-primary" type="submit">Sauvegarder</button>
                                    </div>
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
                    <div class="mt-4 py-4 text-center">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-9/12 px-4">
                                <input type="textarea" value="{{ $user->bio }}" name="bio"
                                    class="text-center border-2 border-gray-500 border-t-0 border-l-0 border-r-0 bg-inherit">
                                @error('bio')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
