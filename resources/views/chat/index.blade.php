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

            <div class="container rounded-xl shadow-lg col-span-2 bg-clear overflow-hidden">
                <div class="overflow-hidden gap-4 p-2 h-full">

                    @include('include.success-message')

                    <div class="px-8 pt-8 text-2xl font-bold w-full"> Messagerie </div>
                    <br>

                    <div class="overflow-y-scroll h-full space-y-3 px-8">
                        @foreach ($users as $user)
                            <div class="p-6 bg-normal rounded-lg flex items-center space-x-6 font-semibold text-lg">

                                <div class="h-12 w-12"><img src="{{ $user->getImageURL() }}" alt="" class="rounded-full"></div>
                                <span><a href="{{ route('chat.chatbox', $user) }}">{{ $user->name }}</a></span>
                            </div>
                        @endforeach
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
