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
                <div class="overflow-hidden grid grid-cols-1 gap-4 p-2 h-full">

                    @include('include.success-message')
                    @if ($editing ?? false)
                        @include('include.user-edit-card')
                    @else
                        @include('include.user-card')
                    @endif
                </div>
            </div>

            <div class="">
                <div class="fixed w-1/4">
                    <div class="mx-4 shadow-lg rounded-xl">
                        @include('include.search-bar')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
