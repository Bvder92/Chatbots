@extends('layouts.app')
@section('content')
    <div class="py-24 container-fluid ">
        <div class="grid grid-cols-4">
            <div class="">
                <div class="fixed w-1/4 ">
                    <div class="border-2 border-gray-200 mx-4 shadow-lg rounded-xl">
                    @include('include.sidebar')
                    </div>
                </div>
            </div>

            <div class="container border-2 rounded-xl shadow-lg col-span-2">
                <div class="grid grid-cols-1 gap-4 p-2 ">

                    @include('include.success-message')

                    @if($feed ?? false)
                    <div class="px-8 pt-8 text-2xl font-bold w-full"> Feed </div>
                    @else
                    <div class="px-8 pt-8 text-2xl font-bold w-full"> Accueil</div>

                    @endif
                    @include('include.submit-post')

                    @auth
                        @forelse ($posts as $post)
                            @include('include.post-card')
                        @empty
                            <p class="text-center my-3">Aucun résultat</p>
                        @endforelse
                    @endauth

                    {{-- Pagination: --}}
                    <div>
                        {{ $posts->withQueryString()->links() }}
                    </div>

                </div>
            </div>

            <div class="">
                <div class="fixed w-1/4">
                    <div class="border-2 border-gray-200 mx-4 shadow-lg rounded-xl">
                        @include('include.search-bar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
