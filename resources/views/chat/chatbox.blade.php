<script>
    window.recipientId = {{ $recipient->id }}; // on le met dans une globale JS
    console.log('RecipientId: ');
    if (window.recipientId == "") {
        console.log('empty!');
    } else {
        console.log(window.recipientId);
    }
</script>

@extends('layouts.app')
@section('content')
    <div class="pt-20 h-full">
        <div class="grid grid-cols-4 h-full pb-2">
            <div class="h-full">
                <div class="fixed w-1/4 ">
                    <div class=" mx-4 shadow-lg rounded-xl bg-normal">
                        @include('include.sidebar')
                    </div>
                </div>
            </div>

            <div class="container rounded-xl shadow-lg col-span-2 bg-clear overflow-hidden h-full">
                <div class="overflow-hidden h-full flex flex-col space-y-2 p-4">

                    <div class="font-bold text-lg m-4">Discussion</div>

                    <div class="p-6 bg-normal rounded-lg flex items-center space-x-6 font-semibold text-lg mx-4">
                        <div class="h-12 w-12">
                            <a href="{{ route('users.show', $recipient->id) }}"><img src="{{ $recipient->getImageURL() }}" alt="" class="rounded-full"></a>
                        </div>
                        <span><a href="{{ route('users.show', $recipient->id) }}">{{ $recipient->name }}</a></span>
                    </div>
                    <div class="bg-normal overflow-hidden rounded-lg mx-4 flex-grow">
                        <chat-messages :messages="messages" :recipient="{{ $recipient }}"
                            :user="{{ $user }}"></chat-messages>
                    </div>
                    <div class="bg-normal rounded-lg mx-4 mb-4">
                        <chat-form v-on:messagesent="addMessage" :sender="{{ Auth::user() }}"
                            :recipient="{{ $recipient }}"></chat-form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

