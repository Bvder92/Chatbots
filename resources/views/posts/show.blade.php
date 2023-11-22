@extends('layouts.app')
@section('content')
    <div class="container mx-auto w-3/5 border-2 rounded-xl shadow-lg">
        <div class="grid grid-cols-1 gap-4 p-12 ">

            @include('include.success-message')
            @include('include.post-card')


        </div>
    @endsection
