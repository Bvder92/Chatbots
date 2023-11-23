@extends('layouts.app')
@section('content')
    <div class="m-2 border-2 shadow-lg rounded-xl">Messages</div>
    <div class="container mx-auto border-2 rounded-xl shadow-lg col-span-2">
        <div class="grid grid-cols-1 gap-4 p-2 ">

            @include('include.success-message')
            @include('include.post-card')

        </div>
    </div>

    <div class="border-2 shadow-lg mx-2 rounded-xl">
        @include('include.search-bar')
    </div>
@endsection
