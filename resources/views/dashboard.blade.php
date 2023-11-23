@extends('layouts.app')
@section('content')

    <div class="">
        <div class="fixed m-2 border-2 shadow-lg rounded-xl">
            <div class="px-8 pt-8 text-2xl font-bold w-full"> Messages </div>
        </div>
    </div>

    <div class="container mx-auto border-2 rounded-xl shadow-lg col-span-2">
        <div class="grid grid-cols-1 gap-4 p-2 ">

            @include('include.success-message')

            <div class="px-8 pt-8 text-2xl font-bold w-full"> Feed </div>
            @include('include.submit-post')

            @foreach ($posts as $post)
                @include('include.post-card')
            @endforeach

            <div>
                {{ $posts->links() }}
            </div>

        </div>
    </div>

    <div class="">
        <div class="fixed border-2 shadow-lg rounded-xl mx-2">
            @include('include.search-bar')
        </div>
    </div>
@endsection
