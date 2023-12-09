@extends('layouts.app')
@section('content')
    <div class="py-24 container-fluid ">
        <div class="grid grid-cols-4">
            <div class="">
                <div class="fixed w-1/4 ">
                    <div class="mx-4 shadow-lg rounded-xl">
                    @include('include.sidebar')
                    </div>
                </div>
            </div>

            <div class="container rounded-xl shadow-lg col-span-2">
                <div class="grid grid-cols-1 gap-4 p-2 ">

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
