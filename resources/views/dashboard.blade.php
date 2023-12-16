@extends('layouts.app')
@section('content')
    <div class="pt-20 h-full">
        <div class="grid grid-cols-4 h-full pb-12">
            <div class="h-full">
                <div class="fixed w-1/4 ">
                    <div class=" mx-4 shadow-lg rounded-xl bg-normal">
                    @include('include.sidebar')
                    </div>
                </div>
            </div>

            <div class="container rounded-xl shadow-lg col-span-2 bg-clear overflow-hidden h-full">
                    @if($feed ?? false)
                    <div class="px-8 pt-8 text-2xl font-bold w-full"> Feed </div>
                    @else
                    <div class="px-8 pt-8 text-2xl font-bold w-full"> Accueil</div>
                <div class="overflow-hidden  gap-4 p-2 h-full">

                    @include('include.success-message')


                    @endif
                    <div class="overflow-y-scroll h-full space-y-3">
                    @include('include.submit-post')

                    @auth
                        @forelse ($posts as $post)
                            @include('include.post-card')
                        @empty
                            <p class="text-center my-3">Aucun résultat</p>
                        @endforelse
                    @endauth
                    </div>

                </div>
            </div>

            <div class="h-full">
                <div class="fixed w-1/4">
                    <div class=" mx-4 shadow-lg rounded-xl bg-normal">
                        @include('include.search-bar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
